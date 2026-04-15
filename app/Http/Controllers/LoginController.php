<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (!session()->has('url.intended')) {
            $previousUrl = url()->previous();

            if (
                !str_contains($previousUrl, '/login') &&
                !str_contains($previousUrl, '/register')
            ) {
                session(['url.intended' => $previousUrl]);
            }
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

         if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $redirect = $request->input('redirect_to', route('home'));

            if (!str_starts_with($redirect, url('/'))) {
                $redirect = route('home');
            }

            return redirect($redirect);
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}