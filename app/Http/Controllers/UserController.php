<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', 'alpha_dash', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:50', 'confirmed'],
        ]);
        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/')->with('success', 'Thank you for creating an account. You are now logged in.');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginUserName' => ['required'],
            'loginPassword' => ['required'],
        ]);

        if (auth()->attempt([
            'username' => $incomingFields['loginUserName'],
            'password' => $incomingFields['loginPassword']
        ])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You are now logged in.');
        } else {
            return redirect('/')->with('failure', 'Invalid login.');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out.');
    }

    public function showCorrectHomepage()
    {
        if (auth()->check()) {
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
    }
}
