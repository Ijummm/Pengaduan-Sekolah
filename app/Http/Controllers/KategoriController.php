<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ket_kategori' => 'required|max:30|unique:kategori,ket_kategori',
        ]);

        Kategori::create([
            'ket_kategori' => $request->ket_kategori
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }
}