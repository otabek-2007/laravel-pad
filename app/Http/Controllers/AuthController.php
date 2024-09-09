<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function store(UserRequest $request)
    {
        $user = (new AuthService)->store($request);

        // Set a flash message in the session
        return redirect('/debtor/show')->with('success', 'You have registered successfully!');
    }

    public function update(UserRequest $request)
    {
        $user = (new AuthService)->login($request);

        return redirect('/debtor/show')->with('success', 'You have logged in successfully!');
    }


    public function logout()
    {
        (new AuthService)->logout();
        return Redirect::route('login')
            ->with('success', 'You have successfully logged out.');
    }
    public function show()
    {
        $user =  Auth::user();
        return view('profile', compact('user'));
    }
}
