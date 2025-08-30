<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', 'alpha_dash'],
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required', 'min:6', 'max:50'],
        ]);
        User::create($incomingFields);
        return 'Registration logic will go here';
    }
}
