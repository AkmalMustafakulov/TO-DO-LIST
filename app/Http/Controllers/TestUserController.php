<?php

namespace App\Http\Controllers;


use App\Models\TodoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TestUserController extends Controller
{
    public function store(Request $request)
    {
        $rules    = [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required',
        ];
        $messages = [
            'name.required'     => 'Заполните поле имя',
            'email.required'    => 'Заполните поле e-mail',
            'email.email'       => 'Введите действительный e-mail',
            'email.unique'      => 'Этот e-mail уже существует',
            'password.required' => 'Заполните поле паролей',
        ];

        $validated = Validator::make($request->all(), $rules, $messages)->validate();

        $user = User::create($validated);
        Auth::login($user);

        return $user;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if (
            $user = Auth::attempt([
                'email'    => $request->email,
                'password' => $request->password,
            ])
        ) {
            $user_id   = Auth::id();
            $todo_list = TodoList::where('user_id', '=', $user_id)->get();

            return $todo_list;
        } else {
            return "Такого пользователя не существует";
        }
    }

    public function logout()
    {
        auth()->logout();

        return "Вы вышли с аккаунта";
    }
}
