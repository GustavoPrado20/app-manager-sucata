<?php

namespace App\Actions;

use App\Models\Divida;

class CalculateCardsPaidMonthAction
{
    public static function execute($month)
    {
        $yellows = Divida::query()->where('situação', '=', 'Paga')
        ->whereMonth('data_paga', $month)
        ->where('referente', '=', 'Cartão Amarelo')
        ->get()->count();

        $reds = Divida::query()->where('situação', '=', 'Paga')
        ->whereMonth('data_paga', $month)
        ->where('referente', '=', 'Cartão Vermelho')
        ->get()->count();

        $total = ($yellows * 25) + ($reds * 30);

        return $total;
    }
}