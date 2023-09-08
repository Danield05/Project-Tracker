<?php

namespace App\Http\Controllers;

use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{

  
    public function show()
    {
        if(Auth::check()){
            return redirect('/home');
        }
        return view('auth-register');
    }
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $user->notify(new WelcomeNotification());
        return redirect('/login')->with('success', 'Account created successfully');
    }


}
