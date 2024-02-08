<?php

namespace App\Actions;

use App\Models\Divida;

class CalculateAbsencesPaidMonthAction
{
    public static function execute($month)
    {
        $absences = Divida::query()->where('situação', '=', 'Paga')
        ->whereMonth('data_paga', $month)
        ->where('referente', '=', 'Falta')
        ->get()->count();

        $total = $absences * 30;

        return $total;
    }
}