<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request)
    {
        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember ? true : false;

        if (
            Auth::attempt(['username' => $username, 'password' => $password], $remember)
            || Auth::attempt(['email' => $username, 'password' => $password], $remember)
        ) {
            return redirect()->route('dashboard');
        }else{
            return redirect('/')->withErrors(['invalid' => 'You have entered an invalid username or password'])->withInput();
        }
    }

    public function logout(Request $request): RedirectResponse{
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
