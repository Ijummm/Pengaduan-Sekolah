<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputAspirasi;
use App\Models\Kategori; 

class InputAspirasiController extends Controller
{
    public function index() {
        $nis = session('siswa_nis');
        $kategoris = Kategori::all(); 
        $aspirasis = InputAspirasi::where('nis', $nis)->with('kategori')->get();
        
        return view('siswa.dashboard', compact('aspirasis', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'lokasi' => 'required|max:50',
            'ket' => 'required|max:500',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            
            // Simpan ke public/uploads/foto_aspirasi
            $file->move(public_path('uploads/foto_aspirasi'), $nama_file);
            
            $data['foto'] = $nama_file;
        }

        $data['status'] = 'Menunggu';
        InputAspirasi::create($data);

        return redirect()->back()->with('success', 'Aspirasi kamu berhasil dikirim!!');
    }

    public function show($id)
    {
        $aspirasi = InputAspirasi::with('kategori')->findOrFail($id);
        
        return view('siswa.show', compact('aspirasi'));
    }
}