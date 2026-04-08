<?php

namespace App\Http\Controllers;

use App\Models\InputAspirasi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = InputAspirasi::with(['siswa', 'kategori', 'aspirasi']);

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $laporan = $query->latest()->get();
        return view('admin.dashboard', compact('laporan'));
    }

    public function berikanTanggapan(Request $request, $id)
    {
        $laporan = InputAspirasi::findOrFail($id);
        $laporan->update([
            'status' => $request->status,
            'feedback' => $request->feedback
        ]);

        return redirect()->back()->with('success', 'Umpan balik berhasil dikirim!');
    }
}