<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.index', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->email === $request->email) {
            $data = $request->validate([
                'name' => 'required',
                'avatar' => 'nullable|image'
            ]);
        } else {
            $data = $request->validate([
                'name' => 'required',
                'avatar' => 'nullable|image',
                'email' => 'required|email|unique:users'
            ]);
        }

        if ($request->avatar) {
            $data['avatar'] = User::uploadImage($request, $user->id, $user->avatar);
        }
        $user->update($data);
        return back()->with(['success' => 'Профиль успешно изменён.', 'user' => $user]);
    }

    public function deleteAvatar($id)
    {
        if (Auth::user()->staff < 3 && Auth::user()->id != $id) {
            return redirect()->route('user.index')->with('error', 'Нельзя удалить чужой аватар!');
        }
        $user = User::query()->find($id);
        Storage::delete($user->avatar);
        $user->avatar = '';
        $user->save();
        return back()->with('success', 'Удаление аватара пользователя успешно завершено.');
    }


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
        return redirect()->route('home')->with('info', "Регистрация прошла успешно, добро пожаловать, $user->name.");
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
            if (Auth::user()->active < 0) {
                session()->flash('error', 'Ваша учетная запись заблокирована. Если вы считаете, что произошла ошибка, напишите администратору: pzhabbiu@gmail.com');
                Auth::logout();
                return redirect()->route('home');
            }
            $name = Auth::user()->name;
            return redirect()->route('home')->with('info', "Мы рады вас видеть, $name. Авторизация успешно пройдена.");
        }
        return redirect()->back()->with('error', 'Неверно введен адрес электронной почты или пароль.');
    }

    public function logout()
    {
        Auth::logout();
        return back()->with('info', 'Вы успешно вышли из своей учетной записи.');
    }

    public function checkEmail(Request $request)
    {
        $user = User::query()->where('email', '=', $request->res)->first();
        if (isset($user)) {
            return True;
        }
        return 0;
    }
}
