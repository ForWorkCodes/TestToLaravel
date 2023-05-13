<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserBalance;
use App\Models\UserOperaion;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getUser()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json(['ok' => true, 'user' => $user, 'balance' => $user->balance, 'operaions' => $user->operaions]);
        } else {
            return response()->json(['ok' => false]);
        }
    }
}
