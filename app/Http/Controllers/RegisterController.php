<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $previousUrl = session('url.intended', url()->previous());

        if (
            str_contains($previousUrl, '/register') ||
            str_contains($previousUrl, '/login')
        ) {
            $previousUrl = route('home');
        }

        return view('auth.register', compact('previousUrl'));
    }
    
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'name_kanji' => $request->name_kanji,
            'name_kana' => $request->name_kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        $redirect = $request->input('redirect_to', route('home'));

        if (!str_starts_with($redirect, url('/'))) {
             $redirect = route('home');
        }

        return redirect($redirect);
    }
}