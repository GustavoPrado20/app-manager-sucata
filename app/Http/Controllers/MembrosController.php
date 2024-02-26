<?php

namespace App\Http\Controllers;

use App\Actions\CreateMonthlyFeeAction;
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

    public function perfil()
    {
        return view('conteudo.perfil', ['LoginAuth' => Auth::check()]);
    }
}
