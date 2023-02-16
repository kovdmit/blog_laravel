<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::query()->find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::query()->find($id);
        if($request->email === $user->email) {
            $data = $request->validate([
                'name' => 'required',
                'avatar' => 'nullable|image',
                'staff' => 'required|numeric',
                'active' => 'required|numeric',
            ]);
        } else {
            $data = $request->validate([
                'name' => 'required',
                'avatar' => 'nullable|image',
                'staff' => 'required|numeric',
                'active' => 'required|numeric',
                'email' => 'required|email|unique:users'
            ]);
        }
        if($request->avatar) {
            $data['avatar'] = User::uploadImage($request, $user->id, $user->avatar);
        }
        $user->update($data);
        return redirect()->route('users.index')->with('success', "Редактирование пользователя $user->name завершено успешно.");
    }

    public function destroy($id)
    {
        $user = User::query()->find($id);
        if($user->avatar) {
            Storage::delete($user->avatar);
        }
        $user->delete();
        return back()->with('success', 'Удаление пользователя успешно завершено.');
    }
}
