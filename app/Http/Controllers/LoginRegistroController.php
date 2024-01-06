<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginRegistroController extends Controller
{
    public function index(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return view('conteudo.login');
    }

    public function registrarDiretor(Request $request){
        $datavalidate = $request->all();

        $data = ['name' => $datavalidate['nome'], 'email' => $datavalidate['email'], 'password' => $datavalidate['password']];

        $registrar = UserRepository::create($data);

        if($registrar){
            $credenciais = $request->only('email', 'password');

            if(Auth::attempt($credenciais)){
                $request->session()->regenerate();

                return redirect(route('home'));
            }
        }
    }

    public function logarDiretor(Request $request){
        $data = $request->only('email', 'password');

        if(Auth::attempt($data)){
            $request->session()->regenerate();

            return redirect()->intended('/');
        }
        else {
            $erroLogin = 'Email ou Senha Incorretos!';
            return view('conteudo.login',['erroLogin' => $erroLogin]);
        }
    }
}
