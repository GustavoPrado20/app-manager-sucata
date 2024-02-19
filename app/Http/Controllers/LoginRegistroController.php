<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserDirectorRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class LoginRegistroController extends Controller
{
    public function index(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return view('conteudo.login');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function registrarDiretor(StoreUserDirectorRequest $request){
        $datavalidate = $request->validated();

        $data = ['name' => $datavalidate['nome'], 'email' => $datavalidate['email'], 'password' => $datavalidate['password']];

        $registrar = User::query()->create($data);

        if($registrar){
            $credenciais = $request->only('email', 'password');

            if(Auth::attempt($credenciais)){
                $request->session()->regenerate();

                return redirect(route('home'));
            }
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
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

    public function singOut(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }
}
