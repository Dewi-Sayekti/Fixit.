<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aduan;
use App\Models\Rating;

class AduanController extends Controller
{
    /**
     * ✅ FIX UTAMA
     * Index untuk /aduan
     * Delegasikan ke logic aduanList yang sudah benar
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $statusFilter = $request->query('status');

        if ($user->role === 'santri') {
            $aduanQuery = Aduan::where('user_id', $user->id)
                ->with('zona');
        } else {
            $aduanQuery = Aduan::with(['zona', 'user']);
        }

        // Terapkan filter status jika ada
        if ($statusFilter && in_array($statusFilter, ['diadukan', 'diproses', 'perbaikan selesai'])) {
            $aduanQuery->where('status', $statusFilter);
        }

        $aduan = $aduanQuery->latest()->get();

        return view('aduan', compact('aduan', 'user', 'statusFilter'));
    }

    public function store(Request $request)
    {
        abort_if(Auth::user()->role !== 'santri', 403);

        $request->validate([
            'zona_id'    => 'required|exists:zonas,id',
            'gambar'     => 'required|image|max:4096',
            'keterangan' => 'required|string'
        ]);

        $aduanAktif = Aduan::where('user_id', Auth::id())
            ->where('zona_id', $request->zona_id)
            ->whereIn('status', ['diadukan', 'diproses'])
            ->exists();

        if ($aduanAktif) {
            return back()->with('error', 'Masih ada aduan aktif di zona ini.');
        }

        $gambar = $request->file('gambar')->store('aduan', 'public');

        Aduan::create([
            'user_id'    => Auth::id(),
            'zona_id'    => $request->zona_id,
            'gambar'     => $gambar,
            'keterangan' => $request->keterangan,
            'status'     => 'diadukan',
        ]);

        return redirect()->route('aduan.index');
    }

    public function proses($id)
    {
        abort_if(Auth::user()->role !== 'staf', 403);

        $aduan = Aduan::findOrFail($id);
        abort_if($aduan->status !== 'diadukan', 403);

        $aduan->update(['status' => 'diproses']);
        return back();
    }

    public function selesai(Request $request, $id)
    {
        abort_if(Auth::user()->role !== 'staf', 403);

        $request->validate([
            'bukti_selesai' => 'required|image|max:4096'
        ]);

        $aduan = Aduan::findOrFail($id);
        abort_if($aduan->status !== 'diproses', 403);

        $path = $request->file('bukti_selesai')
            ->store('bukti_selesai', 'public');

        $aduan->update([
            'bukti_selesai' => $path,
            'status'        => 'perbaikan selesai'
        ]);

        return back();
    }

    public function rating(Request $request, $id)
    {
        abort_if(Auth::user()->role !== 'santri', 403);

        $request->validate([
            'value' => 'required|integer|min:1|max:5'
        ]);

        $aduan = Aduan::findOrFail($id);
        abort_if($aduan->status !== 'perbaikan selesai', 403);

        if ($aduan->sudahRating(Auth::id())) {
            return back();
        }

        Rating::create([
            'aduan_id' => $aduan->id,
            'user_id'  => Auth::id(),
            'value'    => $request->value
        ]);

        $aduan->zona?->recalcRatingAggregate();

        return back();
    }
}
