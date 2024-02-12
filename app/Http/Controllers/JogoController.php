<?php

namespace App\Http\Controllers;

use App\Actions\UpdateDebtValueAction;
use App\Models\Membro;
use App\Models\RegistroCartao;
use App\Models\RegistroFalta;
use App\Models\RegistroPartida;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JogoController extends Controller
{
    public function index(){
        $times = Time::TimesOrdenado();
        $posicao = 1;

        $dadosJogadores = Membro::allJogadores();
        $dadosJogadoresTimeAzul = Membro::jogadoresTimeAzul();
        $dadosJogadoresTimeVermelho = Membro::jogadoresTimeVermelho();
        $artilheiros = Membro::artilheiros();
        $jogadorCartoes =Membro::jogadoresComCartoes();
        $dadosJogadoresTimes = Membro::jogadoresTimes();
        $ultimosJogos = RegistroPartida::ultimosJogos();

        $LoginAuth = false;
        if(Auth::check())
        {
            $LoginAuth = true;
        }

        return view('conteudo.jogos', [
            'ultimosJogos' => $ultimosJogos,
            'dadosJogadoresTimes' => $dadosJogadoresTimes, 
            'times' => $times, 
            'posicao' => $posicao, 
            'LoginAuth' => $LoginAuth, 
            'dadosJogadores' => $dadosJogadores, 
            'dadosJogadoresTimeAzul' => $dadosJogadoresTimeAzul, 
            'dadosJogadoresTimeVermelho' => $dadosJogadoresTimeVermelho, 
            'artilheiros' => $artilheiros, 
            'jogadorCartoes' => $jogadorCartoes
        ]);
    }

    public function adicionarJogador(Request $request)
    {
        $data = ['jogador' => $request->input('Jogador', []), 'time' => $request->input('time')];        
        $adicionarJogador = Membro::adicionarJogadorTime($data);

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

        $registrarFaltas = RegistroFalta::registrarFalta($dados);

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

        $registrarGols = Membro::registrarGols($data);

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

        $registrarCartao = RegistroCartao::regisrarCatao($data);

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

        $registrarPartida = RegistroPartida::registrarPartida($dados);

        if($registrarPartida)
        {
            return redirect()->back()->with('Registrado com Sucesso');
        }
    }
}