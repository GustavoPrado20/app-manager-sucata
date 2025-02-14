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

        $memberData = Membro::find($memberId);

        $debetData = [];

        // // Verifica se já existe uma mensalidade para este membro no mês e ano atuais
        // $mensalidadeExistente = Divida::where('id_membro', $memberId)
        // ->whereYear('data', $date->year)
        // ->whereMonth('data', $date->month)
        // ->exists();

        // if($mensalidadeExistente){
        //     return null;
        // }

        if($date->month == 1)
        {
            if($memberData['isento'] == false)
            {
                $debetData = [
                    'id_membro' => $memberId,
                    'referente' => 'Mensalidade',
                    'valor' => 25,
                    'data' => $date,
                ];

            }
        }

        if($date->month != 1){

            if(($memberData['ocupação'] == 'Jogador' or $memberData['ocupação'] == 'Diretor e Jogador') and $memberData['isento'] == false and $memberData['acordo'] == false)
            {
                $debetData = [
                    'id_membro' => $memberData['id'],
                    'referente' => 'Mensalidade',
                    'valor' => 50,
                    'data' => $date,
                ];
            }
    
            if((($memberData['ocupação'] == 'Jogador' and $memberData['acordo'] == true) or $memberData['ocupação'] == 'Sócio') and $memberData['isento'] == false)
            {
                $debetData = [
                    'id_membro' => $memberData['id'],
                    'referente' => 'Mensalidade',
                    'valor' => 30,
                    'data' => $date,
                ];
            }
        }
        
        return [
            Divida::query()->create($debetData),
            UpdateDebtValueAction::execute($memberId)
        ];
    }
}
