<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }


    
    public function login(Request $r)
    {
       $kredensial = $r->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Ini check role akun jika petugas pergi ke halaman daftar buku petugas
        // Ini check role akun jika pengunjung pergi ke halaman daftar buku pengunjung
        if(Auth::attempt($kredensial)){
            $user = Auth::user();
            return $user->role === 'petugas'
            ? redirect()->route('users.index')
            : redirect()->route('books.list');
        }
        return redirect()->back()->withErrors(['username' => 'Username salah atau password salah'])->withInput();
        
    }
    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        return redirect()->route('login');
    }
}
