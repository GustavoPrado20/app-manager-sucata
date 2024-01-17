<?php

namespace App\Http\Controllers;

use App\Repositories\TimeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JogoController extends Controller
{
    public function index(){
        $times = TimeRepository::all();
        $posicao = 1;

        if(Auth::check())
        {
            $LoginAuth = true;
        }
        else {
            $LoginAuth = false;
        }

        return view('conteudo.jogos', ['times' => $times, 'posicao' => $posicao, 'LoginAuth' => $LoginAuth]);
    }
}