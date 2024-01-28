<?php

namespace App\Http\Controllers;

use App\Models\RegistroDivida;
use App\Repositories\DespesaRepository;
use App\Repositories\DividaRepository;
use App\Repositories\MembroRepository;
use App\Repositories\ReceitaRepository;
use App\Repositories\RegistroDividaRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancasController extends Controller
{
    public function index()
    {
        $dividas = RegistroDivida::with('NomeMembro')->where('total-divida', '>', 0)->get();
        $dadosMembros = MembroRepository::findByStatus(True);
        $dadosReceitas = ReceitaRepository::all();
        $dadosDespesas = DespesaRepository::all();

        $mes = Carbon::now()->month;

        $faltasPagasMes = (DividaRepository::FaltasPagaMes($mes)->count() * 30);
        $mensalidades = (DividaRepository::MensalidadesJogadoresPagaMes($mes)->count() * 40) + (DividaRepository::MensalidadesSociosPagaMes($mes)->count() * 20) + (DividaRepository::MensalidadesPagaJaneiro($mes)->count() * 10) ;
        $cartoes = (DividaRepository::CartaoAmareloPagaMes($mes)->count() * 20) + (DividaRepository::CartaoVermelhoPagaMes($mes)->count() * 25);

        $dividasTotalDados = DividaRepository::dividasTotal();
        $dividaTotal = 0;

        foreach($dividasTotalDados as $dividaTotalDado)
        {
            $dividaTotal = $dividaTotalDado['valor'] + $dividaTotal;
        }

        $totalFuturo = $dividaTotal  + (MembroRepository::sociosEAcordo()->count() * 20) + (MembroRepository::jogadoresSemAcordo()->count() * 40);
        
        $dividasPagas = DividaRepository::dividasPagas();
        $receitas = 0;

        foreach($dividasPagas as $dividaPaga)
        {
            $receitas = $dividaPaga['valor'] + $receitas;
        }

        $despesaTotal = 0;

        foreach($dadosDespesas as $dadoDespesa)
        {
            $despesaTotal = $dadoDespesa['valor'] + $despesaTotal;
        }

        $despesaJuizMes = (DespesaRepository::JuizDespesaMes($mes)->count() * 100);
        $outrasDespesaMes = DespesaRepository::outrasDespesaMes($mes);
        $totalOutraDespesaMes = 0;

        foreach($outrasDespesaMes as $outraDespesa)
        {
            $totalOutraDespesaMes = $outraDespesa['valor'] + $totalOutraDespesaMes;
        }

        $mesJaneiro = 1;

        $faltasPagasMesJaneiro = (DividaRepository::FaltasPagaMes($mesJaneiro)->count() * 30);
        $mensalidadesJaneiro = (DividaRepository::MensalidadesJogadoresPagaMes($mesJaneiro)->count() * 40) + (DividaRepository::MensalidadesSociosPagaMes($mes)->count() * 20) + (DividaRepository::MensalidadesPagaJaneiro($mes)->count() * 10) ;
        $cartoesJaneiro = (DividaRepository::CartaoAmareloPagaMes($mesJaneiro)->count() * 20) + (DividaRepository::CartaoVermelhoPagaMes($mes)->count() * 25);

        $totalJaneiro = $faltasPagasMesJaneiro + $mensalidadesJaneiro + $cartoesJaneiro;

        if(Auth::check())
        {
            $LoginAuth = true;
        }
        else {
            $LoginAuth = false;
        }

        return view('conteudo.finanças', [
            'dividas' => $dividas, 
            'dadosMembros' => $dadosMembros, 
            'dadosReceitas' => $dadosReceitas, 
            'LoginAuth' => $LoginAuth, 
            'dadosDespesas' => $dadosDespesas,
            'FaltasPagasMes' => $faltasPagasMes,
            'mensalidades' => $mensalidades,
            'cartoes' => $cartoes,
            'receitas' => $receitas,
            'despesaTotal' => $despesaTotal,
            'despesaJuizMes' => $despesaJuizMes,
            'totalFuturo' => $totalFuturo,
            'totalOutraDespesaMes' => $totalOutraDespesaMes,
            'totalJaneiro' => $totalJaneiro,
        ]);
    }

    public function adicionarFinanças(Request $request)
    {
        $data = ['id_membro' => $request->input('membro'), 'id_dividas' => $request->input('divida', []), 'valor' => $request['valor']];

        ReceitaRepository::adicionarReceita($data);
            
        RegistroDividaRepository::atualizar(intval($data['id_membro']));

        return redirect()->route('financas');
    }

    public function adicionarDespesas(Request $request)
    {
        $dados = ['referencia' => $request['referencia'], 'valor' => $request['valor'], 'data' => Carbon::now()];

        DespesaRepository::create($dados);

        return redirect()->route('financas');
    }
}
