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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            if (Auth::user()->active<0) {
                session()->flash('error', 'Ваша учетная запись заблокирована. Если вы считаете, что произошла ошибка, напишите администратору: example@email.com');
                Auth::logout();
                return redirect()->route('home');
            }
            return redirect()->route('home')->with('success', 'Авторизация успешно пройдена');
        }
        return redirect()->back()->with('error', 'Неверно введен адрес электронной почты или пароль.');
    }

    public function logout()
    {
        Auth::logout();
        return back()->with('success', 'Вы успешно вышли из своей учетной записи.');
    }
}
