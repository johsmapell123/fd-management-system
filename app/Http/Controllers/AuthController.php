<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        //validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        //coba login dengan Auth
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect sesuai posisi/role
            Log::info('Login success', ['id' => Auth::id(), 'position' => Auth::user()->position]);

            return $this->redirectByRole(Auth::user()->position)->with('success', 'Logged in successfully!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    protected function redirectByRole($position) 
    {
        return match ($position) {
            'Admin' => redirect()->route('dashboard.admin'),
            'Manager' => redirect()->route('manager.dashboard.manager'),
            'Staff' => redirect()->route('dashboard.staff'),
            default => abort(403),
        };
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
