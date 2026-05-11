from flask import Flask, request, jsonify
import pandas as pd
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

@app.route('/hitung-saw', methods=['POST'])
def hitung_saw():
    try:
        data = request.json
        
        # Load data ke DataFrame
        df_penilaian = pd.DataFrame(data['penilaian'])
        df_kriteria = pd.DataFrame(data['kriteria'])
        df_bobot = pd.DataFrame(data['bobot'])

        # Fix: Konversi nilai ke numeric dan tangani NaN
        df_penilaian['nilai'] = pd.to_numeric(df_penilaian['nilai'], errors='coerce').fillna(0)
        df_bobot['bobot'] = pd.to_numeric(df_bobot['bobot'], errors='coerce').fillna(0)
        
        # Debug: Print incoming data
        print("\n=== DEBUG: Data Penilaian ===")
        print(df_penilaian.head())
        print("\n=== DEBUG: Data Kriteria ===")
        print(df_kriteria)
        print("\n=== DEBUG: Data Bobot ===")
        print(df_bobot)

        # 1. PROSES NORMALISASI (R)
        df_penilaian['normalisasi'] = 0.0
        
        for _, krit in df_kriteria.iterrows():
            k_id = krit['id']
            tipe = krit['tipe']
            mask = df_penilaian['kriteria_id'] == k_id
            
            if tipe == 'benefit':
                max_val = float(df_penilaian.loc[mask, 'nilai'].max())
                # Prevent division by zero
                if max_val == 0:
                    max_val = 0.0001
                df_penilaian.loc[mask, 'normalisasi'] = df_penilaian.loc[mask, 'nilai'].astype(float) / max_val
            else:  # cost
                min_val = float(df_penilaian.loc[mask, 'nilai'].min())
                # Prevent division by zero
                if min_val == 0:
                    min_val = 0.0001
                df_penilaian.loc[mask, 'normalisasi'] = min_val / df_penilaian.loc[mask, 'nilai'].astype(float)

        # 2. PERHITUNGAN SKOR AKHIR (V)
        # Gabungkan bobot ke penilaian
        weight_map = dict(zip(df_bobot['kriteria_id'], df_bobot['bobot']))
        df_penilaian['skor_bobot'] = df_penilaian.apply(
            lambda x: x['normalisasi'] * weight_map.get(x['kriteria_id'], 0), axis=1
        )

        # Total skor per wisata
        hasil = df_penilaian.groupby('wisata_id')['skor_bobot'].sum().reset_index()
        hasil.columns = ['wisata_id', 'skor']
        
        # Urutkan dari yang tertinggi
        hasil = hasil.sort_values(by='skor', ascending=False)

        print("\n=== DEBUG: Hasil SAW ===")
        print(hasil)
        print("\n=== Hasil berhasil dihitung ===")
        
        return jsonify(hasil.to_dict(orient='records'))

    except Exception as e:
        import traceback
        error_msg = str(e)
        error_trace = traceback.format_exc()
        print("\n=== ERROR DETAIL ===")
        print(f"Error: {error_msg}")
        print(f"Traceback:\n{error_trace}")
        print("=== END ERROR ===")
        return jsonify({"error": error_msg, "traceback": error_trace}), 500

if __name__ == '__main__':
    app.run(port=5000, debug=True)