<?php

namespace App\Models;

use App\Actions\CalculateAbsencesPaidMonth;
use App\Actions\CalculateCardsPaidMonth;
use App\Actions\CalculateMonthlyPayments;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divida extends Model
{
    use HasFactory;

    protected $table = 'dividas';

    protected $fillable = [
        'id_membro',
        'referente',
        'valor',
        'data'
    ];

    public static function pendingDebts(int $memberId)
    {
        return self::query()->where('id_membro', '=', $memberId)
        ->where('situação', '=', 'Pendente')
        ->get();
    }

    public static function updateIdDebt(int $id, array $attributes = []){
        return self::query()->where(['id' => $id])->update($attributes);
    }

    public static function totalRevenue()
    {
        $receitas = self::query()->where('situação', '=', 'Paga')->get();

        $total = 0;

        foreach($receitas as $receita)
        {
            $total = $receita['valor'] + $total;
        }
        
        return $total;
    }

    public static function totalForecastForDecember()
    {
        $dividas = self::query()->where('referente', '!=', 'Mensalidade')->get();
        $totalDivida = 0;

        foreach ($dividas as $divida)
        {
            $totalDivida = $divida['valor'] + $totalDivida;
        }

        $jogadoresEntradaJaneiro = Membro::query()->where('status', '=', true)
        ->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->whereMonth('data-entrada-time', '=', 1)
        ->get()
        ->count();

        $jogadores = Membro::query()->where('status', '=', true)
        ->where('acordo', '=', false)->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->get();

        $totalJogadores = 0;

        foreach($jogadores as $jogador)
        {
            $date = Carbon::parse($jogador['data-entrada-time'])->month;

            $mesesRestantes = 12 - $date + 1;

            $totalJogadores = ($mesesRestantes * 40) + $totalJogadores;
        }

        $socios = Membro::query()->where('status', '=', true)
        ->where(function($query){
            $query->where('ocupação', '=', 'Sócio')
            ->orWhere('acordo', '=', true);
        })->get();

        $totalSocio = 0;

        foreach($socios as $socio)
        {
            $date = Carbon::parse($socio['data-entrada-time'])->month;

            $mesesRestantes = 12 - $date + 1;

            $totalSocio = ($mesesRestantes * 20) + $totalSocio;
        }

        $total = $totalDivida + $totalJogadores + $totalSocio + ($jogadoresEntradaJaneiro * 10);

        return $total;
    }

    public static function totalReceivedMonths()
    {
        $meses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $totalMeses = [];

        for($count = 0; $count < 12; $count ++)
        {
            $faltasPagas = CalculateAbsencesPaidMonth::execute($meses[$count]);
            $mensalidadesPagas = CalculateMonthlyPayments::execute($meses[$count]);
            $cartoesPagos = CalculateCardsPaidMonth::execute($meses[$count]);

            $totalMeses[$count] = htmlspecialchars(strval($faltasPagas + $mensalidadesPagas + $cartoesPagos), ENT_QUOTES, 'UTF-8');
        }

        return $totalMeses;
    }
}
