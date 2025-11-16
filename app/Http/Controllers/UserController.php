<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

 
    public function create()
    {
        // Beri data roles ke halaman create
        $roles = ['pengunjung', 'petugas'];
        return view('users.create', compact('roles'));
    }


    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:4',
            'role' => 'required|in:pengunjung,petugas',
        ]);

        User::create([
            'name' => $r->name,
            'username' => $r->username,
            'password' => Hash::make($r->password),
            'role' => $r->role,
        ]);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
