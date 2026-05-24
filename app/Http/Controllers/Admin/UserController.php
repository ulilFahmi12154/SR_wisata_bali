<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // 1. Filter Fitur Pencarian (Mencocokkan nama atau email)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 2. Filter Peran/Role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Urutkan berdasarkan data terbaru lalu paginasikan hasil (misal: 10 atau sesuai kebutuhan)
        $users = $query->latest()->paginate(10);

        return view('pages.admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role' => 'required|in:admin,user',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'role' => 'required|in:admin,user',
            'old_password' => 'nullable|string',
            'password' => 'nullable|string|min:8',
        ]);

        // Jika admin/user mencoba mengetikkan password baru
        if ($request->filled('password')) {
            // Harus isi password lama sebagai verifikasi keamanan
            if (!$request->filled('old_password')) {
                return redirect()->back()->with('error', 'Password lama wajib diisi untuk mengubah password baru.');
            }

            // Cek kecocokan password lama ke hash database
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'Password lama yang dimasukkan tidak sesuai.');
            }

            // Enkripsi password baru
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Kamu tidak bisa menghapus akunmu sendiri yang sedang aktif.');
        }
        
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}