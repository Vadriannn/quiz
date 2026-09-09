<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('daftar-barang');
        }
        return view('auth.login');
    }

    /**
     * Proses login pengguna
     */
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required'    => 'Username atau email harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        $input = $request->input('login');
        $password = $request->input('password');

        // Cari pegawai berdasarkan email ATAU nama (username)
        $pegawai = Pegawai::where('email', $input)
            ->orWhere('nama', $input)
            ->first();

        if ($pegawai && Hash::check($password, $pegawai->password)) {
            Auth::login($pegawai, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->intended('/daftar-barang');
        }

        return back()->withErrors([
            'login' => 'Username/Email atau password yang Anda masukkan salah.',
        ])->withInput($request->only('login', 'remember'));
    }

    /**
     * Tampilkan form registrasi
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('daftar-barang');
        }
        return view('auth.register');
    }

    /**
     * Proses registrasi akun baru
     */
    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|string|email|max:100|unique:pegawais,email',
            'notelp'   => 'nullable|string|max:15',
            'password' => 'required|string|min:4|confirmed',
            'role'     => 'in:Admin,User,admin,user',
        ], [
            'nama.required'      => 'Nama lengkap harus diisi.',
            'email.required'     => 'Email harus diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email ini sudah terdaftar.',
            'password.required'  => 'Password harus diisi.',
            'password.min'       => 'Password minimal 4 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required'      => 'Role akun harus dipilih.',
        ]);

        $roleFormatted = ucfirst(strtolower($request->input('role', 'User')));

        $pegawai = Pegawai::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'notelp'   => $request->notelp,
            'Role'     => $roleFormatted,
        ]);

        Auth::login($pegawai);
        $request->session()->regenerate();

        return redirect()->route('daftar-barang')->with('success', 'Akun berhasil dibuat dan berhasil masuk!');
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
