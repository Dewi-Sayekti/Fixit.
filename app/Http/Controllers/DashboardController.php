<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use App\Models\Aduan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function jelajah()
    {
        $user = Auth::user();

        $zona = Zona::withCount(['aduan as open_aduan_count' => function ($q) {
            $q->whereIn('status', ['diadukan', 'diproses']);
        }])->get();

        return view('jelajah', [
            'user' => $user,
            'role' => $user->role,
            'zona' => $zona
        ]);
    }

    // ✅ INI SATU-SATUNYA LIST ADUAN
    public function aduanList()
    {
        $user = Auth::user();

        if ($user->role === 'santri') {
            $aduan = Aduan::where('user_id', $user->id)
                ->with('zona')
                ->latest()
                ->get();
        } else {
            $aduan = Aduan::with(['zona', 'user'])
                ->orderByRaw("FIELD(status, 'diadukan', 'diproses', 'perbaikan selesai')")
                ->get();
        }

        return view('aduan', compact('aduan', 'user'));
    }

    public function zonaDetail($id)
    {
        $zona = Zona::with('aduan')->findOrFail($id);
        return response()->json($zona);
    }
}
