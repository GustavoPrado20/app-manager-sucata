<?php

namespace App\Actions;

use App\Models\Divida;
use App\Models\RegistroDivida;
use Carbon\Carbon;

class UpdateDebtValueAction
{
    public static function execute(int $memberId)
    {
        $pendingDebts = Divida::pendingDebts($memberId);

        $ano = Carbon::now()->year;

        $totalValue = 0;

        foreach($pendingDebts as $pendingDebt)
        {
            $totalValue = $pendingDebt['valor'] + $totalValue;
        }

        return RegistroDivida::updateIdMember($memberId, ['total-divida' => $totalValue, 'ano' => $ano]);
    }
}