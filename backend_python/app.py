from flask import Flask, request, jsonify
import pandas as pd
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

INTEREST_KEYWORDS = {
    "nature": ["nature", "alam", "hutan", "gunung", "danau", "terasering", "air terjun"],
    "culture": ["culture", "budaya", "heritage", "pura", "candi", "desa", "tarian", "sejarah"],
    "beach": ["beach", "pantai", "coast", "laut", "pasir", "selancar", "snorkeling"],
    "culinary": ["culinary", "kuliner", "food", "makan", "restoran", "kopi"],
}

AMENITY_KEYWORDS = {
    "parking": ["parkir", "parking"],
    "wifi": ["wifi"],
    "restroom": ["toilet", "restroom", "kamar mandi"],
    "restaurant": ["restoran", "warung", "makan", "kuliner"],
}


def normalize_text(value):
    return str(value or "").strip().lower()


def to_float(value, default=0.0):
    try:
        if value is None or value == "":
            return default
        return float(value)
    except (TypeError, ValueError):
        return default


def to_int(value, default=None):
    try:
        if value is None or value == "":
            return default
        return int(float(value))
    except (TypeError, ValueError):
        return default


def prepare_dataframe(data):
    df_penilaian = pd.DataFrame(data.get("penilaian", []))
    df_kriteria = pd.DataFrame(data.get("kriteria", []))
    df_bobot = pd.DataFrame(data.get("bobot", []))

    required_penilaian = {"wisata_id", "kriteria_id", "nilai"}
    required_kriteria = {"id", "nama_kriteria", "tipe"}
    required_bobot = {"kriteria_id", "bobot"}

    if df_penilaian.empty or df_kriteria.empty or df_bobot.empty:
        return df_penilaian, df_kriteria, df_bobot

    if not required_penilaian.issubset(df_penilaian.columns):
        raise ValueError("Payload penilaian tidak lengkap.")
    if not required_kriteria.issubset(df_kriteria.columns):
        raise ValueError("Payload kriteria tidak lengkap.")
    if not required_bobot.issubset(df_bobot.columns):
        raise ValueError("Payload bobot tidak lengkap.")

    df_penilaian["wisata_id"] = pd.to_numeric(df_penilaian["wisata_id"], errors="coerce")
    df_penilaian["kriteria_id"] = pd.to_numeric(df_penilaian["kriteria_id"], errors="coerce")
    df_penilaian["nilai"] = pd.to_numeric(df_penilaian["nilai"], errors="coerce").fillna(0)

    df_kriteria["id"] = pd.to_numeric(df_kriteria["id"], errors="coerce")
    df_kriteria["nama_kriteria"] = df_kriteria["nama_kriteria"].fillna("")
    df_kriteria["tipe"] = df_kriteria["tipe"].fillna("benefit").str.lower()

    df_bobot["kriteria_id"] = pd.to_numeric(df_bobot["kriteria_id"], errors="coerce")
    df_bobot["bobot"] = pd.to_numeric(df_bobot["bobot"], errors="coerce").fillna(0)

    df_penilaian = df_penilaian.dropna(subset=["wisata_id", "kriteria_id"])
    df_kriteria = df_kriteria.dropna(subset=["id"])
    df_bobot = df_bobot.dropna(subset=["kriteria_id"])

    return df_penilaian, df_kriteria, df_bobot


def forward_chaining(filters, df_kriteria, df_bobot):
    facts = []
    rules = []
    multipliers = {}
    base_weights = {
        int(row["kriteria_id"]): float(row["bobot"])
        for _, row in df_bobot.iterrows()
    }

    budget = to_int(filters.get("budget"), 0) or 0
    interest = normalize_text(filters.get("interest") or "all")
    regency = normalize_text(filters.get("regency") or "all")
    amenities = [normalize_text(item) for item in filters.get("amenities", []) if normalize_text(item)]

    if budget > 0 and budget <= 100000:
        facts.append("budget_terbatas")
        rules.append("FW01: Budget terbatas menaikkan prioritas kriteria harga.")
        for _, row in df_kriteria.iterrows():
            name = normalize_text(row["nama_kriteria"])
            if "harga" in name:
                multipliers[int(row["id"])] = multipliers.get(int(row["id"]), 1.0) * 1.35
    elif budget > 100000:
        facts.append("budget_tersedia")
        rules.append("FW02: Budget tersedia tetap menjadikan harga sebagai pertimbangan.")

    if amenities:
        facts.append("butuh_fasilitas")
        rules.append("FW03: Fasilitas wajib menaikkan prioritas kriteria fasilitas.")
        for _, row in df_kriteria.iterrows():
            name = normalize_text(row["nama_kriteria"])
            if "fasilitas" in name:
                multipliers[int(row["id"])] = multipliers.get(int(row["id"]), 1.0) * 1.25

    if interest and interest != "all":
        facts.append(f"minat_{interest}")
        rules.append("FW04: Minat wisata digunakan sebagai fakta kategori untuk seleksi kandidat.")

    if regency and regency != "all":
        facts.append(f"lokasi_{regency}")
        rules.append("FW05: Kabupaten pilihan digunakan sebagai fakta lokasi untuk seleksi kandidat.")

    if not facts:
        facts.append("preferensi_umum")
        rules.append("FW00: Preferensi umum menggunakan bobot kriteria default.")

    adjusted_weights = {}
    for _, row in df_kriteria.iterrows():
        criteria_id = int(row["id"])
        adjusted_weights[criteria_id] = base_weights.get(criteria_id, 0.0) * multipliers.get(criteria_id, 1.0)

    adjusted_total = sum(adjusted_weights.values())
    base_total = sum(base_weights.values()) or 1.0

    if adjusted_total > 0:
        adjusted_weights = {
            criteria_id: (weight / adjusted_total) * base_total
            for criteria_id, weight in adjusted_weights.items()
        }

    return facts, rules, adjusted_weights


def contains_any(text, keywords):
    haystack = normalize_text(text)
    return any(normalize_text(keyword) in haystack for keyword in keywords)


def prove_budget(alternative, budget):
    if budget <= 0:
        return True, "Budget tidak dibatasi."

    price = to_int(alternative.get("harga_wni_min"))
    if price is None:
        return True, "Harga belum tersedia, kandidat tetap dipertimbangkan."

    if price <= budget:
        return True, f"Harga Rp {price:,} sesuai budget."

    return False, f"Harga Rp {price:,} melebihi budget."


def prove_regency(alternative, regency):
    if not regency or regency == "all":
        return True, "Lokasi tidak dibatasi."

    location = normalize_text(alternative.get("lokasi"))
    if regency in location:
        return True, "Lokasi sesuai kabupaten pilihan."

    return False, "Lokasi tidak sesuai kabupaten pilihan."


def prove_interest(alternative, interest):
    if not interest or interest == "all":
        return True, "Kategori tidak dibatasi."

    keywords = INTEREST_KEYWORDS.get(interest, [interest])
    text = " ".join([
        normalize_text(alternative.get("kategori")),
        normalize_text(alternative.get("nama")),
        normalize_text(alternative.get("deskripsi")),
        normalize_text(alternative.get("keterangan")),
    ])

    if contains_any(text, keywords):
        return True, "Kategori/minat wisata sesuai preferensi."

    return False, "Kategori/minat wisata tidak sesuai preferensi."


def prove_amenities(alternative, amenities):
    if not amenities:
        return True, "Fasilitas tidak diwajibkan."

    facilities = " ".join([normalize_text(item) for item in alternative.get("fasilitas", [])])
    missing = []

    for amenity in amenities:
        keywords = AMENITY_KEYWORDS.get(amenity, [amenity])
        if not contains_any(facilities, keywords):
            missing.append(amenity)

    if not missing:
        return True, "Fasilitas wajib terpenuhi."

    return False, "Fasilitas wajib belum terpenuhi: " + ", ".join(missing)


def backward_chaining(filters, alternatives, df_penilaian):
    scored_ids = {
        int(wisata_id)
        for wisata_id in df_penilaian["wisata_id"].dropna().unique().tolist()
    }

    if not alternatives:
        return scored_ids, {
            wisata_id: ["Memiliki data penilaian untuk perhitungan SAW."]
            for wisata_id in scored_ids
        }, []

    budget = to_int(filters.get("budget"), 0) or 0
    interest = normalize_text(filters.get("interest") or "all")
    regency = normalize_text(filters.get("regency") or "all")
    amenities = [normalize_text(item) for item in filters.get("amenities", []) if normalize_text(item)]

    eligible_ids = set()
    reasons_by_id = {}
    rejected = []

    for alternative in alternatives:
        wisata_id = to_int(alternative.get("id"))
        if wisata_id is None:
            continue

        goals = []
        reasons = []

        if wisata_id not in scored_ids:
            goals.append(False)
            reasons.append("Tidak memiliki data penilaian SAW.")
        else:
            goals.append(True)
            reasons.append("Memiliki data penilaian SAW.")

        for prover in [
            lambda: prove_budget(alternative, budget),
            lambda: prove_regency(alternative, regency),
            lambda: prove_interest(alternative, interest),
            lambda: prove_amenities(alternative, amenities),
        ]:
            passed, reason = prover()
            goals.append(passed)
            reasons.append(reason)

        if all(goals):
            eligible_ids.add(wisata_id)
            reasons_by_id[wisata_id] = reasons
        else:
            rejected.append({
                "wisata_id": wisata_id,
                "alasan": [reason for passed, reason in zip(goals, reasons) if not passed],
            })

    return eligible_ids, reasons_by_id, rejected


def calculate_saw(df_penilaian, df_kriteria, weight_map, eligible_ids, reasons_by_id):
    if df_penilaian.empty or df_kriteria.empty or not eligible_ids:
        return []

    filtered = df_penilaian[df_penilaian["wisata_id"].astype(int).isin(eligible_ids)].copy()
    if filtered.empty:
        return []

    filtered["normalisasi"] = 0.0

    for _, criterion in df_kriteria.iterrows():
        criteria_id = int(criterion["id"])
        criteria_type = normalize_text(criterion["tipe"])
        mask = filtered["kriteria_id"].astype(int) == criteria_id
        values = filtered.loc[mask, "nilai"].astype(float)

        if values.empty:
            continue

        if criteria_type == "cost":
            positive_values = values[values > 0]
            min_value = float(positive_values.min()) if not positive_values.empty else 0.0001
            normalized_values = values.apply(lambda value: 1.0 if value <= 0 else min_value / value)
            filtered.loc[mask, "normalisasi"] = normalized_values
        else:
            max_value = float(values.max())
            if max_value <= 0:
                filtered.loc[mask, "normalisasi"] = 0.0
            else:
                filtered.loc[mask, "normalisasi"] = values / max_value

    filtered["skor_bobot"] = filtered.apply(
        lambda row: row["normalisasi"] * weight_map.get(int(row["kriteria_id"]), 0.0),
        axis=1,
    )

    result = (
        filtered.groupby("wisata_id")["skor_bobot"]
        .sum()
        .reset_index()
        .rename(columns={"skor_bobot": "skor"})
        .sort_values(by="skor", ascending=False)
    )

    records = []
    for _, row in result.iterrows():
        wisata_id = int(row["wisata_id"])
        records.append({
            "wisata_id": wisata_id,
            "skor": round(float(row["skor"]), 6),
            "metode": "Forward Chaining + Backward Chaining + SAW",
            "alasan": reasons_by_id.get(wisata_id, []),
        })

    return records


@app.route("/hitung-saw", methods=["POST"])
@app.route("/hitung-fw-bw-saw", methods=["POST"])
def hitung_rekomendasi():
    try:
        data = request.get_json(silent=True) or {}
        filters = data.get("filters", {})
        alternatives = data.get("wisata", [])

        df_penilaian, df_kriteria, df_bobot = prepare_dataframe(data)
        if df_penilaian.empty or df_kriteria.empty or df_bobot.empty:
            return jsonify([])

        facts, rules, adjusted_weights = forward_chaining(filters, df_kriteria, df_bobot)
        eligible_ids, reasons_by_id, rejected = backward_chaining(filters, alternatives, df_penilaian)
        result = calculate_saw(df_penilaian, df_kriteria, adjusted_weights, eligible_ids, reasons_by_id)

        print("\n=== DEBUG: FW + BW + SAW ===")
        print("Fakta FW:", facts)
        print("Aturan FW:", rules)
        print("Kandidat lolos BW:", len(eligible_ids))
        print("Kandidat ditolak BW:", len(rejected))
        print("Hasil SAW:", result[:5])
        print("=== Hasil berhasil dihitung ===")

        return jsonify(result)

    except Exception as e:
        import traceback

        error_msg = str(e)
        error_trace = traceback.format_exc()
        print("\n=== ERROR DETAIL ===")
        print(f"Error: {error_msg}")
        print(f"Traceback:\n{error_trace}")
        print("=== END ERROR ===")
        return jsonify({"error": error_msg, "traceback": error_trace}), 500


if __name__ == "__main__":
    app.run(port=5000, debug=True)
