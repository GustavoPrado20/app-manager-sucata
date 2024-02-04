<?php

namespace App\Actions;

use App\Models\Divida;

class CalculateMonthlyPayments
{
    public static function execute(int $month)
    {
        $januaryPayments = Divida::query()->where('situação', '=', 'Paga')
        ->whereMonth('data_paga', $month)
        ->where('referente', '=', 'Mensalidade')
        ->where('valor', '=', 10)
        ->get()->count();

        $paidPlayers = Divida::query()->where('situação', '=', 'Paga')
        ->whereMonth('data_paga', $month)
        ->where('referente', '=', 'Mensalidade')
        ->where('valor', '=', 40)
        ->get()->count();

        $paidPartners  = Divida::query()->where('situação', '=', 'Paga')
        ->whereMonth('data_paga', $month)
        ->where('referente', '=', 'Mensalidade')
        ->where('valor', '=', 20)
        ->get()->count();

        $total = ($januaryPayments * 10) + ($paidPlayers * 40) + ($paidPartners * 20);
        
        return $total;
    }
}