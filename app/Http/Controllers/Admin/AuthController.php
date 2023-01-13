<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController {

    public function login() {
        $url = 'https://github.com/login/oauth/authorize';
        $parametrs = [
            'client_id' => getenv('OAUTH_GITHUB_CLIENT_ID'),
            'redirect_uri' => getenv('OAUTH_GITHUB_REDIRECT_URI'),
            'scope' => 'user'
        ];
        $url .= '?'.http_build_query($parametrs);
        return view ('admin/auth/form', compact('url'));
    }

    public function handleLogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($credentials['password']);
                $user->save();
            }
            return redirect()->route('admin.panel');
        }
        return back()->withErrors([
            'email' => 'Incorrect email or password',
        ]);

    }

    public function logout() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
