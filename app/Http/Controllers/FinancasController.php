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

        // Dividas Pagas No Mês Atual - Receitas Pagas No Mês Atual
        $mes = Carbon::now()->month;

        $faltasPagasMes = DividaRepository::FaltasPagaMes($mes);
        $totalPagoMensalidades = DividaRepository::mensalidadesPagasMes($mes);
        $totalPagoCartoes = DividaRepository::cartoesPagosMes($mes);
        //-------------------------------------------------------------

        $totalFuturo = DividaRepository::totalPrevsDez(); // Saldo total previsto para o Mês de Dezembro
        
        $receitas = DividaRepository::receitaTotal(); // Valor total recebido até o momento atual

        $despesaTotal = DespesaRepository::despesaTotal(); //Valor total gasto até o momento

        //Despesas Do Mes Atual
        $despesaJuizMes = (DespesaRepository::JuizDespesaMes($mes)->count() * 90); //Despesas Referente ao Pagamento do Juiz

        $totalOutraDespesaMes = DespesaRepository::totalOutrasDespesasMes($mes);
        //---------------------------------------------------------------------------

        // Dividas Pagas No Mês de Janeiro - Receitas Pagas No Mês de Janeiro
        $totalPagoMeses = DividaRepository::totalRecebidoNosMeses();
        // //----------------------------------------------------------------------------------

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
            'mensalidades' => $totalPagoMensalidades,
            'cartoes' => $totalPagoCartoes,
            'receitas' => $receitas,
            'despesaTotal' => $despesaTotal,
            'despesaJuizMes' => $despesaJuizMes,
            'totalFuturo' => $totalFuturo,
            'totalOutraDespesaMes' => $totalOutraDespesaMes,
            'totalPagoMeses' => $totalPagoMeses,
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
