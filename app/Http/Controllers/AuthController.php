<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('login')->with('success', 'Roʻyxatdan o‘tish muvaffaqiyatli bajarildi!');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // 1. Ma'lumotni tekshirish
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Loginni tekshirish
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Sessionni yangilaydi
            return redirect()->intended()->with('success', 'Tizimga muvaffaqiyatli kirdingiz!');
        }

        // 3. Agar xato bo‘lsa
        throw ValidationException::withMessages([
            'email' => 'Email yoki parol noto‘g‘ri!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Tizimdan chiqdingiz.');
    }
}
