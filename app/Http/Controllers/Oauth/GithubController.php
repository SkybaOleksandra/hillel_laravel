<?php

namespace App\Http\Controllers\Oauth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Exception;

class GithubController
{
    public function __invoke() {

        $url = 'https://github.com/login/oauth/access_token';
        $parametrs = [
            'client_id' => getenv('OAUTH_GITHUB_CLIENT_ID'),
            'client_secret' => getenv('OAUTH_GITHUB_CLIENT_SECRET'),
            'redirect_uri' => getenv('OAUTH_GITHUB_REDIRECT_URI'),
            'code' => request()->input('code'),
        ];
        $url .= '?'.http_build_query($parametrs);
        $response = Http::post($url);

        if (!$response->ok()) {
            throw new Exception('error');
        }

        $data = [];
        parse_str($response->body(), $data);

        if (!isset($data['access_token'])) {
            return redirect()->route('admin.login');
        }

        $user = Http::withHeaders([
            'Authorization' => 'Bearer '.$data['access_token']
        ])->get('https://api.github.com/user');

        if (!$this->createUser($user->json())) {
            $errorText='Failed to get email address from GitHub. Please add your email address on GitHub or sign up on this website';
            return view('admin/auth/form', compact('errorText'));
        }
        return redirect()->route('admin.panel');

    }

    public function createUser($userGit) {

        if (!isset($userGit['email'])) {
            return false;
        }

        $user=User::where('email', $userGit['email'])->first();

        if (empty($user)) {
            $user = User::create([
                'name' => $userGit['name'],
                'email' => $userGit['email'],
                'password' => Hash::make($userGit['id'].'_'.rand(5348, 15348).'%'.$userGit['node_id']),
                'role_name' => 'reader',
            ]);
        }
        Auth::login($user);
        return true;
    }
}
