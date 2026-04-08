<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginAdmin() {
        return view('auth.login_admin');
    }

    public function loginAdmin(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_logged_in', true);
            Session::put('admin_username', $admin->username);
            
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function showRegisterSiswa() {
        return view('auth.register_siswa');
    }

    public function registerSiswa(Request $request) {
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'kelas' => 'required|max:10',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'kelas' => $request->kelas,
        ]);

        return redirect('/login-siswa')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function showLoginSiswa() {
        return view('auth.login_siswa');
    }

    public function loginSiswa(Request $request) {
        $request->validate([
            'nis' => 'required',
        ]);

        $siswa = Siswa::where('nis', $request->nis)->first();

        if ($siswa) {
            session(['siswa_nis' => $siswa->nis]);
            return redirect('/siswa/dashboard');
        }

        return back()->withErrors(['nis' => 'NIS tidak terdaftar.']);
    }

    public function logout()
    {
        Session::flush(); 
        return redirect('/')->with('success', 'Anda telah keluar dari sistem.');
    }
}