<?php

namespace App\Http\Controllers;

use App\Repositories\MembroRepository;
use App\Repositories\TimeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JogoController extends Controller
{
    public function index(){
        $times = TimeRepository::all();
        $posicao = 1;

        $dadosJogadores = MembroRepository::allJogadores();
        $dadosJogadoresTimeAzul = MembroRepository::jogadoresTimeAzul();
        $dadosJogadoresTimeVermelho = MembroRepository::jogadoresTimeVermelho();
        $artilheiros = MembroRepository::artilheiros();
        $jogadorCartoes =MembroRepository::jogadoresComCartoes();
        $dadosJogadoresTimes = MembroRepository::jogadoresTimes();

        if(Auth::check())
        {
            $LoginAuth = true;
        }
        else {
            $LoginAuth = false;
        }

        return view('conteudo.jogos', ['dadosJogadoresTimes' => $dadosJogadoresTimes, 'times' => $times, 'posicao' => $posicao, 'LoginAuth' => $LoginAuth, 'dadosJogadores' => $dadosJogadores, 'dadosJogadoresTimeAzul' => $dadosJogadoresTimeAzul, 'dadosJogadoresTimeVermelho' => $dadosJogadoresTimeVermelho, 'artilheiros' => $artilheiros, 'jogadorCartoes' => $jogadorCartoes]);
    }

    public function adicionarJogador(Request $request)
    {
        $data = ['jogador' => $request->input('Jogador', []), 'time' => $request->input('time')];        
        $adicionarJogador = MembroRepository::adicionarJogadorTime($data);

        if($adicionarJogador){
           return redirect()->back()->with('Adicionado com Sucesso');
        }
    }
}