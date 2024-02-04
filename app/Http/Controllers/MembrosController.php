<?php

namespace App\Http\Controllers;

use App\Actions\CreateJanuaryMonthlyAction;
use App\Actions\CreateMonthlyFeeAction;
use App\Models\Divida;
use App\Models\Membro;
use App\Models\RegistroDivida;
use App\Repositories\MembroRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use Carbon\Carbon;

class MembrosController extends Controller
{
    public function index()
    {
        $LoginAuth = false;
        if(Auth::check()){
            $LoginAuth = true;
        }

        $dadosMembros = Membro::findByStatus(true);
        $dadosMembrosInativos = Membro::findByStatus(false);

        return view('conteudo.membros',[
            'LoginAuth' => $LoginAuth, 
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

            return redirect(route('membros'));
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
        
        $atualizarDados = Membro::updateIdMember($idMembro, $dados);

        if($atualizarDados){
            return redirect(route('membros'));
        }
    }

    public function search(Request $request){
        $nomeApelido = $request['nomeApelido'];
        $LoginAuth = false;

        if(Auth::check()){
            $LoginAuth = true;
        }

        if(empty($nomeApelido))
        {
            $dadosMembros = Membro::findByStatus(true);
            $dadosMembrosInativos = Membro::findByStatus(false);

            return view('conteudo.membros',[
                'LoginAuth' => $LoginAuth, 
                'dadosMembros' => $dadosMembros, 
                'dadosMembrosInativos' => $dadosMembrosInativos
            ]);
        }
        else{
            $dadosMembrosInativos = Membro::findByStatus(false);
            $busca = Membro::findByNomeApelido($nomeApelido);
    
            if($busca){
                return view('conteudo.membros', [
                    'dadosMembros' => $busca, 
                    'dadoMembroInativos' => $dadosMembrosInativos, 
                    'LoginAuth' => $LoginAuth
                ]);
            }
        }
    }
}
