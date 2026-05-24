<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;   // Sesuaikan jika nama model Anda 'Destination'
use App\Models\Kategori; // Sesuaikan jika nama model Anda 'Category'
use App\Models\Lokasi;   // Sesuaikan jika nama model Anda 'Location'
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    /**
     * Menampilkan daftar destinasi wisata (Halaman Index)
     */
    public function index()
    {
        // Mengambil data wisata beserta relasi kategori dan lokasi, lalu di-paginate
        $destinations = Wisata::with(['kategori', 'lokasi'])->latest()->paginate(5);
        
        return view('pages.admin.destinations.index', compact('destinations'));
    }

    /**
     * Menampilkan form tambah destinasi baru
     */
    public function create()
    {
        $categories = Kategori::all();
        $locations = Lokasi::all();
        
        return view('pages.admin.destinations.create', compact('categories', 'locations'));
    }

    /**
     * Menyimpan data destinasi baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id'   => 'required|exists:lokasi,id',
            'harga_tiket' => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        Wisata::create($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi wisata berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit untuk destinasi tertentu
     */
    public function edit($id)
    {
        $destination = Wisata::findOrFail($id);
        $categories = Kategori::all();
        $locations = Lokasi::all();

        return view('pages.admin.destinations.edit', compact('destination', 'categories', 'locations'));
    }

    /**
     * Memperbarui data destinasi di database
     */
    public function update(Request $request, $id)
    {
        $destination = Wisata::findOrFail($id);

        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'lokasi_id'   => 'required|exists:lokasi,id',
            'harga_tiket' => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Proses ganti gambar jika ada file baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($destination->image) {
                Storage::disk('public')->delete($destination->image);
            }
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi wisata berhasil diperbarui!');
    }

    /**
     * Menghapus destinasi dari database
     */
    public function destroy($id)
    {
        $destination = Wisata::findOrFail($id);

        // Hapus file gambar dari storage sebelum menghapus row data
        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi wisata berhasil dihapus!');
    }
}