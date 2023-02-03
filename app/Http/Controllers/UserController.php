<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function regCreate()
    {
        return view('user.register');
    }

    public function regStore(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        Auth::login($user);
        return redirect()->route('home')->with('success', "Регистрация прошла успешно, добро пожаловать, $user->name.");
    }

    public function authCreate()
    {
        return view('user.login');
    }

    public function authStore(Request $request)
    {
        Auth::attempt([
            'email' => $request->email,
            'password' => $request->pw,
            'active' => 0,
        ]);
        return redirect()->route('home')->with('success', 'Авторизация успешно пройдена');
    }

    public function logout()
    {
        //
    }
}
