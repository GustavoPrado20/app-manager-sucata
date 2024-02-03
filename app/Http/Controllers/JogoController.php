<?php

namespace App\Http\Controllers;

use App\Actions\UpdateDebtValueAction;
use App\Repositories\MembroRepository;
use App\Repositories\RegistroCartaoRepository;
use App\Repositories\RegistroDividaRepository;
use App\Repositories\RegistroFaltaRepository;
use App\Repositories\RegistroPartidaRepository;
use App\Repositories\TimeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JogoController extends Controller
{
    public function index(){
        $times = TimeRepository::TimesOrdenado();
        $posicao = 1;

        $dadosJogadores = MembroRepository::allJogadores();
        $dadosJogadoresTimeAzul = MembroRepository::jogadoresTimeAzul();
        $dadosJogadoresTimeVermelho = MembroRepository::jogadoresTimeVermelho();
        $artilheiros = MembroRepository::artilheiros();
        $jogadorCartoes =MembroRepository::jogadoresComCartoes();
        $dadosJogadoresTimes = MembroRepository::jogadoresTimes();
        $ultimosJogos = RegistroPartidaRepository::ultimosJogos();

        if(Auth::check())
        {
            $LoginAuth = true;
        }
        else {
            $LoginAuth = false;
        }

        return view('conteudo.jogos', ['ultimosJogos' => $ultimosJogos, 'dadosJogadoresTimes' => $dadosJogadoresTimes, 'times' => $times, 'posicao' => $posicao, 'LoginAuth' => $LoginAuth, 'dadosJogadores' => $dadosJogadores, 'dadosJogadoresTimeAzul' => $dadosJogadoresTimeAzul, 'dadosJogadoresTimeVermelho' => $dadosJogadoresTimeVermelho, 'artilheiros' => $artilheiros, 'jogadorCartoes' => $jogadorCartoes]);
    }

    public function adicionarJogador(Request $request)
    {
        $data = ['jogador' => $request->input('Jogador', []), 'time' => $request->input('time')];        
        $adicionarJogador = MembroRepository::adicionarJogadorTime($data);

        if($adicionarJogador){
           return redirect()->back()->with('Adicionado com Sucesso');
        }
    }

    public function registrarFalta(Request $request)
    {
        $dados = [
            'data' => $request->input('data'), 
            'motivo' => $request->input('motivo'), 
            'jogador' => $request->input('Jogador', [])
        ];

        $registrarFaltas = RegistroFaltaRepository::registrarFalta($dados);

        if($registrarFaltas)
        {
            foreach($dados['jogador'] as $idJogador)
            {
                UpdateDebtValueAction::execute(intval($idJogador));
            }
            return redirect()->back()->with('Registrado com Sucesso');
        }
    }

    public function registrarGols(Request $request)
    {
        $data = [
            'jogador' => $request->input('Jogador', []), 
            'gols' => $request->input('gols')
        ];

        $registrarGols = MembroRepository::registrarGols($data);

        if($registrarGols)
        {
            return redirect()->back()->with('Registrado com Sucesso');
        }
    }

    public function registrarCartoes(Request $request)
    {
        $data = [
            'cor' => $request->input('cor'), 
            'jogador' => $request->input('Jogador', [])
        ];

        $registrarCartao = RegistroCartaoRepository::regisrarCatao($data);

        if($registrarCartao)
        {
            foreach($data['jogador'] as $idJogador)
            {
                UpdateDebtValueAction::execute(intval($idJogador));
            }
            return redirect()->back()->with('Registrado com Sucesso');
        }
    }

    public function registrarPartidas(Request $request)
    {
        $dados = [
            'placar' => $request['placar'], 
            'resultado' => $request['resultado'], 
            'data' => $request['data']
        ];

        $registrarPartida = RegistroPartidaRepository::registrarPartida($dados);

        if($registrarPartida)
        {
            return redirect()->back()->with('Registrado com Sucesso');
        }
    }
}