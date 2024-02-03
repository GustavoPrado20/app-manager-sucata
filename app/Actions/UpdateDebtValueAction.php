<?php

namespace App\Actions;

use App\Models\Divida;
use App\Models\RegistroDivida;

class UpdateDebtValueAction
{
    public static function execute(int $memberId)
    {
        $pendingDebts = Divida::pendingDebts($memberId);

        $totalValue = 0;

        foreach($pendingDebts as $pendingDebt)
        {
            $totalValue = $pendingDebt['valor'] + $totalValue;
        }

        return RegistroDivida::updateIdMember($memberId, ['total-divida' => $totalValue]);
    }
}