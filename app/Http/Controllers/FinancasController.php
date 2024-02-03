<?php

namespace App\Http\Controllers;

use App\Actions\CalculateAbsencesPaidMonth;
use App\Actions\CalculateCardsPaidMonth;
use App\Actions\CalculateMonthlyPayments;
use App\Actions\UpdateDebtValueAction;
use App\Models\Despesa;
use App\Models\Divida;
use App\Models\Membro;
use App\Models\Receita;
use App\Models\RegistroDivida;
use App\Repositories\DespesaRepository;
use App\Repositories\DividaRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancasController extends Controller
{
    public function index()
    {
        $dividas = RegistroDivida::with('NomeMembro')->where('total-divida', '>', 0)->get();
        $dadosMembros = Membro::findByStatus(True);
        $dadosReceitas = Receita::all();
        $dadosDespesas = Despesa::all();

        // Dividas Pagas No Mês Atual - Receitas Pagas No Mês Atual
        $month = Carbon::now()->month;

        $faltasPagasMes = CalculateAbsencesPaidMonth::execute($month);
        $totalPagoMensalidades = CalculateMonthlyPayments::execute($month);
        $totalPagoCartoes = CalculateCardsPaidMonth::execute($month);
        //-------------------------------------------------------------

        $totalFuturo = Divida::totalForecastForDecember(); // Saldo total previsto para o Mês de Dezembro
        
        $receitas = Divida::totalRevenue(); // Valor total recebido até o momento atual

        $despesaTotal = DespesaRepository::despesaTotal(); //Valor total gasto até o momento

        //Despesas Do Mes Atual
        $despesaJuizMes = (DespesaRepository::JuizDespesaMes($month)->count() * 90); //Despesas Referente ao Pagamento do Juiz

        $totalOutraDespesaMes = DespesaRepository::totalOutrasDespesasMes($month);
        //---------------------------------------------------------------------------

        // Dividas Pagas No Mês de Janeiro - Receitas Pagas No Mês de Janeiro
        $totalPagoMeses = Divida::totalReceivedMonths();
        // //----------------------------------------------------------------------------------

        $LoginAuth = false;
        if(Auth::check())
        {
            $LoginAuth = true;
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
        $data = [
            'id_membro' => $request->input('membro'), 
            'id_dividas' => $request->input('divida', []), 
            'valor' => $request['valor']
        ];

        Receita::addRecipes($data);
            
        UpdateDebtValueAction::execute(intval($data['id_membro']));

        return redirect()->route('financas');
    }

    public function adicionarDespesas(Request $request)
    {
        $dados = ['referencia' => $request['referencia'], 'valor' => $request['valor'], 'data' => Carbon::now()];

        Despesa::query()->create($dados);

        return redirect()->route('financas');
    }
}
