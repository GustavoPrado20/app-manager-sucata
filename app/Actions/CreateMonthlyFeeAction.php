<?php

namespace App\Actions;

use App\Models\Divida;
use App\Models\Membro;
use Carbon\Carbon;

class CreateMonthlyFeeAction
{
    /**
     * Undocumented function
     *
     * @param integer $memberId
     * @return Divida
     */
    public static function execute(int $memberId)
    {
        $date = Carbon::now();

        if($date->month == 1)
        {
            $memberData = Membro::find($memberId);

            if($memberData['ocupação'] == 'Jogador' or $memberData['ocupação'] == 'Diretor e Jogador')
            {
                $DebtRegistration = [
                    'id_membro' => $memberId,
                    'referente' => 'Mensalidade',
                    'valor' => 25,
                    'data' => $date,
                ];

                return [
                    Divida::query()->create($DebtRegistration),
                    UpdateDebtValueAction::execute($memberId)
                ];
            }
        }
        else
        {
            $memberData = Membro::find($memberId);

            if(($memberData['ocupação'] == 'Jogador' or $memberData['ocupação'] == 'Diretor e Jogador') and ($memberData['acordo'] == true))
            {
                $debetData = [
                    'id_membro' => $memberData['id'],
                    'referente' => 'Mensalidade',
                    'valor' => 25,
                    'data' => $date,
                ];

                 return [
                    Divida::query()->create($debetData),
                    UpdateDebtValueAction::execute($memberId)
                ];
            }
            else
            {
                $debetData = [
                    'id_membro' => $memberData['id'],
                    'referente' => 'Mensalidade',
                    'valor' => 30,
                    'data' => $date,
                ];

                return [
                    Divida::query()->create($debetData),
                    UpdateDebtValueAction::execute($memberId)
                ];
            }
        }
    }
}
