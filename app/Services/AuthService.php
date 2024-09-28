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
            // If you're using Laravel Sanctum or Passport
            $user->tokens()->delete();
    
            // Log the user out
            Auth::logout();
    
            // Optionally, invalidate the session and regenerate CSRF token
            request()->session()->invalidate();
            request()->session()->regenerateToken();
    
            // Redirect to login page or a specific route
            return redirect('/user/login'); // Adjust this route as necessary
        }
    
        // Redirect to login page if user was not authenticated
        return redirect()->route('login'); // Adjust this route as necessary
    }
    
}
