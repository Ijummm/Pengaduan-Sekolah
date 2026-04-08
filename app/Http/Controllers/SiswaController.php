<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'lokasi' => 'required',
            'ket' => 'required',
        ]);

        $laporan = InputAspirasi::create([
            'nis' => Auth::user()->nis, 
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
            'status' => 'Menunggu'
        ]);

        return redirect()->back()->with('success', 'Aspirasi berhasil dikirim!');
    }
}
