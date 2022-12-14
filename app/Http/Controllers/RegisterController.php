<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('register');
    }

    public function create(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'email' => ['required', 'email', 'unique:users',],
            'password' => 'required',
            'passwordConfirm' => ['required', 'same:password'],
        ],[
            'user.required' => 'Preencha o campo de usúario',
            'email.required' => 'Preencha o campo de email.',
            'email.unique' => 'Email já cadastrado!',
            'email.email' => 'Email inválido',
            'password.required' => 'Preencha o campo de senha',
            'passwordConfirm.required' => 'Preencha o campo de confirmar senha',
            'passwordConfirm.same' => 'Senha e confirmar senha não correspondem!'
        ]);

        $create = User::create([
            'name'     => $request->input('user'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if ($create) {

            $credentials = [
                'email'    => $request->input('email'),
                'password' => $request->input('password')
            ];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/');
            }
        }

        return redirect()->route('user.register')->with('error', 'Erro ao realizar cadastro, tente novamente!');

    }
}
