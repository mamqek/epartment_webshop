<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function authenticate()
    {   

        if (!Auth::check()) {
            Log::info('User is not logged in');
            $user = User::where('email', 'test@example.com')->first();
            Auth::login($user);
        }
        Log::info(Auth::check());
        return Auth::user();
    }
}
