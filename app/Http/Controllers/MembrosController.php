<?php

namespace App\Http\Controllers;

use App\Actions\CreateMonthlyFeeAction;
use App\Models\Divida;
use App\Models\Membro;
use App\Models\RegistroDivida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MembrosController extends Controller
{
    public function index()
    {
        $dadosMembros = Membro::findByStatus(true);
        $dadosMembrosInativos = Membro::findByStatus(false);

        return view('conteudo.membros',[
            'LoginAuth' => Auth::check(), 
            'dadosMembros' => $dadosMembros, 
            'dadosMembrosInativos' => $dadosMembrosInativos
        ]);
    }

    public function Registrar(Request $request){
        $dataAtual = Carbon::now();
        $acordo = false;

        if(!empty($request['acordo']))
        {
            $acordo = $request['acordo'];
        }

        $dados = [
            'nome' => $request['nome'],
            'apelido' => $request['apelido'], 
            'ocupação' => $request['ocupação'], 
            'data-entrada-time' => $dataAtual, 
            'status' => true, 
            'acordo' => $acordo
        ];

        $registrar = Membro::query()->create($dados);

        if($registrar)
        {
            $dadosRegistroDivida = ['id_membro' => $registrar->id, 'ano' => $dataAtual->year];
            RegistroDivida::query()->create($dadosRegistroDivida);

            CreateMonthlyFeeAction::execute($registrar->id);

            return redirect()->back();
        }
    }

    public function update(Request $request){
        $idMembro = $request['idMembro'];
        $acordo = false;

        if(!empty($request['acordo']))
        {
            $acordo = $request['acordo'];
        }

        $dados = [
            'nome' => $request['nome'], 
            'apelido' => $request['apelido'], 
            'ocupação' => $request['ocupação'], 
            'acordo' => $acordo
        ];
        
        $atualizarDados = Membro::updateId($idMembro, $dados);

        if($atualizarDados){
            return redirect()->back();
        }
    }

    public function search(Request $request){
        $nomeApelido = $request['nomeApelido'];

        if(empty($nomeApelido))
        {
            return redirect()->back();
        }
            $dadosMembrosInativos = Membro::findByStatus(false);
            $busca = Membro::findByNomeApelido($nomeApelido);
    
        if($busca){
            return view('conteudo.membros', [
                'dadosMembros' => $busca, 
                'dadosMembrosInativos' => $dadosMembrosInativos, 
                'LoginAuth' => Auth::check()
            ]);
        }
    }

    public function menssagemDebt()
    {
        $membros = Membro::findByStatus(true);

        foreach($membros as $membro)
        {
            $mensalidades = Divida::query()->where('id_membro', '=', $membro['id'])
            ->where('situação', '=', 'Pendente')->where('referente', '=', 'Mensalidade')
            ->get();

            $faltas = Divida::query()->where('id_membro', '=', $membro['id'])
            ->where('situação', '=', 'Pendente')->where('referente', '=', 'Falta')
            ->get();

            $cartaoYellows = Divida::query()->where('id_membro', '=', $membro['id'])
            ->where('situação', '=', 'Pendente')->where('referente', '=', 'Cartão Amarelo')
            ->get();

            $cartaoReds = Divida::query()->where('id_membro', '=', $membro['id'])
            ->where('situação', '=', 'Pendente')->where('referente', '=', 'Cartão Vermelho')
            ->get();

            if($membro['ocupação'] == 'Jogador' or $membro['ocupação'] == 'Diretor e Jogador')
            {
                $totalMensalidade = 0;

                foreach($mensalidades as $mensalidade)
                {
                    $totalMensalidade = $mensalidade['valor'] + $totalMensalidade;
                }

                $totalFalta = 0;

                foreach($faltas as $falta)
                {
                    $totalFalta = $falta['valor'] + $totalFalta;
                }

                $totalYellow = 0;

                foreach($cartaoYellows as $cartaoYellow)
                {
                    $totalYellow = $cartaoYellow['valor'] + $totalYellow;
                }

                $totalRed = 0;

                foreach($cartaoReds as $cartaoRed)
                {
                    $totalRed = $cartaoRed['valor'] + $totalRed;
                }

                if($membro['acordo'] == false)
                {
                    echo '<h3>*Débito Sucata*</h3>
                    <p>Membro: '.$membro['nome'].'</p>
                    <p>'.($totalMensalidade / 40).' Mensalidades: R$ '.$totalMensalidade.',00</p>
                    <p>'.($totalFalta / 30).' Faltas: R$ '.$totalFalta.',00</p>
                    <p>'.($totalYellow / 20).' Cartões Amarelos: R$ '.$totalYellow.',00</p>
                    <p>'.($totalRed / 25).' Cartões Vermelhos: R$ '.$totalRed.',00</p>
                    <p>Valor Total: R$ '.($totalMensalidade + $totalFalta + $totalRed + $totalYellow).',00</p>
                    <p>Pix: (11) 941809128</p>';
                }
                else
                {
                    echo '<h3>*Débito Sucata*</h3>
                    <p>Membro: '.$membro['nome'].'</p>
                    <p>'.($totalMensalidade / 20).' Mensalidades: R$ '.$totalMensalidade.',00</p>
                    <p>'.($totalFalta / 30).' Faltas: R$ '.$totalFalta.',00</p>
                    <p>'.($totalYellow / 20).' Cartões Amarelos: R$ '.$totalYellow.',00</p>
                    <p>'.($totalRed / 25).' Cartões Vermelhos: R$ '.$totalRed.',00</p>
                    <p>Valor Total: R$ '.($totalMensalidade + $totalFalta + $totalRed + $totalYellow).',00</p>
                    <p>Pix: (11) 941809128</p>';
                }
            }
            else
            {
                $totalMensalidade = 0;

                foreach($mensalidades as $mensalidade)
                {
                    $totalMensalidade = $mensalidade['valor'] + $totalMensalidade;
                }

                echo '<h3>*Débito Sucata*</h3>
                    <p>Membro: '.$membro['nome'].'</p>
                    <p>'.($totalMensalidade / 20).' Mensalidades: R$ '.$totalMensalidade.',00</p>
                    <p>Valor Total: R$ '.$totalMensalidade.',00</p>
                    <p>Pix: (11) 941809128</p>';
            }
        }
    }

    public function perfil()
    {
        return view('conteudo.perfil', ['LoginAuth' => Auth::check()]);
    }
}
