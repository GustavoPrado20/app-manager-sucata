<?php

namespace App\Http\Controllers;

use App\Repositories\TimeRepository;
use Illuminate\Http\Request;

class JogoController extends Controller
{
    public function index(){
        $times = TimeRepository::all();
        $posicao = 1;
        return view('conteudo.jogos', ['times' => $times, 'posicao' => $posicao]);
    }
}
