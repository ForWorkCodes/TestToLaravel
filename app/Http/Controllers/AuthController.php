<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function logout()
    {
        auth('web')->logout();

        return redirect(route('home'));
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => ["required", "email", "string"],
            "password" => ["required"]
        ]);

        if (auth('web')->attempt($data)) {
            $request->session()->regenerate();

            return response()->json(['message' => 'Auth success']);
        }

        return response()->json(['error' => 'Invalid user'], 401);
    }

}
