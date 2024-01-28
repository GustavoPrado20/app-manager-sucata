<?php

namespace App\Http\Controllers;

use App\Models\Membro;
use App\Repositories\DividaRepository;
use App\Repositories\MembroRepository;
use App\Repositories\RegistroDividaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use Carbon\Carbon;

class MembrosController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $LoginAuth = true;
        }
        else{
            $LoginAuth = false;
        }

        $dadosMembros = MembroRepository::findByStatus(true);
        $dadosMembrosInativos = MembroRepository::findByStatus(false);

        return view('conteudo.membros',['LoginAuth' => $LoginAuth, 'dadosMembros' => $dadosMembros, 'dadosMembrosInativos' => $dadosMembrosInativos]);
    }

    public function Registrar(Request $request){
        $dataAtual = Carbon::now();
        $mesAtual = $dataAtual->month;

        if(!empty($request['acordo']))
        {
            $acordo = $request['acordo'];
        }
        else
        {
            $acordo = false;
        }

        $dados = ['nome' => $request['nome'],'apelido' => $request['apelido'], 'ocupação' => $request['ocupação'], 'data-entrada-time' => $dataAtual, 'status' => true, 'acordo' => $acordo];

        $registrar = MembroRepository::create($dados);

        if($registrar){
            if($mesAtual == 1)
            {
                $dadosMembro = MembroRepository::findById(intval($registrar->id));

                if($dadosMembro['ocupação'] == 'Jogador' or $dadosMembro['ocupação'] == 'Diretor e Jogador')
                {
                    $data = ['id_membro' => $dadosMembro['id'], 'referente' => 'Mensalidade', 'valor' => 10, 'data' => $dataAtual];
                    DividaRepository::create($data);
                }
            }

            $dadosRegistroDivida = ['id_membro' => $registrar->id, 'ano' => $dataAtual->year];
            RegistroDividaRepository::create($dadosRegistroDivida);
            RegistroDividaRepository::atualizar(intval($registrar->id));

            return redirect(route('membros'));
        }
    }

    public function update(Request $request){
        $idMembro = $request['idMembro'];

        $dados = ['nome' => $request['nome'], 'apelido' => $request['apelido'], 'ocupação' => $request['ocupação'], 'acordo' => $request['acordo']];
        
        $atualizarDados = MembroRepository::update($idMembro, $dados);

        if($atualizarDados){
            return redirect(route('membros'));
        }
    }

    public function search(Request $request){
        $nomeApelido = $request['nomeApelido'];

        if(Auth::check()){
            $LoginAuth = true;
        }
        else{
            $LoginAuth = false;
        }

        if(empty($nomeApelido))
        {
            $dadosMembros = MembroRepository::findByStatus(true);
            $dadosMembrosInativos = MembroRepository::findByStatus(false);

            return view('conteudo.membros',['LoginAuth' => $LoginAuth, 'dadosMembros' => $dadosMembros, 'dadosMembrosInativos' => $dadosMembrosInativos]);
        }
        else{
            $dadosMembrosInativos = MembroRepository::findByStatus(false);
            $busca = MembroRepository::findByNomeApelido($nomeApelido);
    
            if($busca){
                return view('conteudo.membros', ['dadosMembros' => $busca, 'dadoMembroInativos' => $dadosMembrosInativos, 'LoginAuth' => $LoginAuth]);
            }
        }
    }
}
