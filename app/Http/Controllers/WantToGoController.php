<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\WantToGo;
use App\Models\Wisata;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WantToGoController extends Controller
{
    public function index(Request $request): View
    {
        $wantToGos = WantToGo::query()
            ->with(['wisata.kategori', 'wisata.lokasi'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(12);

        return view('pages.user.want-to-go.index', [
            'wantToGos' => $wantToGos,
        ]);
    }

    public function toggle(Request $request, Wisata $destination): RedirectResponse
    {
        $user = $request->user();

        $existing = WantToGo::query()
            ->where('user_id', $user->id)
            ->where('wisata_id', $destination->id)
            ->first();

        if ($existing) {
            $existing->delete();

            return back()->with('status', 'Destinasi dihapus dari daftar ingin dikunjungi.');
        }

        WantToGo::create([
            'user_id' => $user->id,
            'wisata_id' => $destination->id,
        ]);

        ActivityLog::create([
            'session_id' => $request->session()->getId(),
            'user_id' => $user->id,
            'wisata_id' => $destination->id,
            'user_name' => $user->name,
            'action_type' => 'want_to_go',
            'action' => 'Menambahkan want to go: ' . $destination->nama,
            'icon' => 'bookmark',
            'weight' => 5,
            'metadata' => ['source' => 'want_to_go_toggle'],
            'url' => $request->fullUrl(),
            'ip_address' => $request->ip(),
        ]);

        return back()->with('status', 'Destinasi ditambahkan ke daftar ingin dikunjungi.');
    }
}
