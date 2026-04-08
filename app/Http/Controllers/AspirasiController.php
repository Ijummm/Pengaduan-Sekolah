<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputAspirasi;

class AspirasiController extends Controller
{
    public function index()
    {
        $data_aspirasi = InputAspirasi::with('kategori')->get();

        return view('admin.dashboard', compact('data_aspirasi'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string'
        ]);

        $aspirasi = InputAspirasi::findOrFail($id);
        
        $aspirasi->status = $request->status;
        $aspirasi->feedback = $request->feedback;
        $aspirasi->save();

        return back()->with('success', 'Status aspirasi berhasil diperbarui!');
    }

    public function feedback($id)
    {
        $aspirasi = InputAspirasi::findOrFail($id);
        return view('admin.feedback', compact('aspirasi'));
    }

    public function updateFeedback(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'required|min:5',
            'status' => 'required'
        ]);

        $aspirasi = InputAspirasi::findOrFail($id);
        $aspirasi->update([
            'feedback' => $request->feedback,
            'status' => $request->status
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Feedback berhasil dikirim!');
    }
}
