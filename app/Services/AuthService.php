<?php

namespace App\Services;

use App\Models\User; // Ensure this is the correct model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function store($data)
    {
        $user = new User;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        $token = $user->createToken('mytokenapp')->plainTextToken;

        Auth::login($user);
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $response;
    }
    public function login($data)
    {
        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password))
            abort(401, 'Пароль или имя пользователя неверны!');
        $token = $user->createToken('myapptoken')->plainTextToken;
        session()->regenerate();

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return $response;
    }
    public function logout()
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();
            Auth::logout();
            return $user;
        }

        return [
            'message' => 'No user is authenticated'
        ];
    }
}
