<?php

namespace App\Actions;

use App\Models\Divida;

class CalculateCardsPaidMonth
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

        $total = ($yellows * 20) + ($reds * 25);

        return $total;
    }
}