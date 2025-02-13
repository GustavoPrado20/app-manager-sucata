<?php

namespace App\Actions;

use App\Models\Divida;

class CalculateMonthlyPaymentsAction
{
    public static function execute(int $month)
    {
        $januaryPayments = Divida::query()->where('situação', '=', 'Paga')
        ->whereMonth('data_paga', $month)
        ->where('referente', '=', 'Mensalidade')
        ->where('valor', '=', 25)
        ->get()->count();

        $paidPlayers = Divida::query()->where('situação', '=', 'Paga')
        ->whereMonth('data_paga', $month)
        ->where('referente', '=', 'Mensalidade')
        ->where('valor', '=', 50)
        ->get()->count();

        $paidPartners  = Divida::query()->where('situação', '=', 'Paga')
        ->whereMonth('data_paga', $month)
        ->where('referente', '=', 'Mensalidade')
        ->where('valor', '=', 30)
        ->get()->count();

        $total = ($januaryPayments * 25) + ($paidPlayers * 50) + ($paidPartners * 30);
        
        return $total;
    }
}