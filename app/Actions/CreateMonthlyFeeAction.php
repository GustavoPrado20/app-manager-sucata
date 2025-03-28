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
        if (!$memberData) {
            return null;
        }
        if ($memberData['isento']) {
            return null;
        }

        $debetData = null;

        // Verifica se já existe uma mensalidade para este membro no mês e ano atuais
        $mensalidadeExistente = Divida::where('id_membro', $memberId)
        ->where('referente', 'Mensalidade')
        ->whereYear('data', $date->year)
        ->whereMonth('data', $date->month)
        ->exists();

        if($mensalidadeExistente){
            return null;
        }

        //Criar Mensalidade em Janeiro
        if($date->month == 1)
        {
            if(!$memberData['isento'])
            {
                $debetData = [
                    'id_membro' => $memberId,
                    'referente' => 'Mensalidade',
                    'valor' => 25,
                    'data' => $date,
                ];

            }
        }

        //Criar Mensalidades nos demais Meses
        if(($memberData['ocupação'] == 'Jogador' or $memberData['ocupação'] == 'Diretor e Jogador') and $memberData['acordo'] == false)
        {
            $debetData = [
                'id_membro' => $memberData['id'],
                'referente' => 'Mensalidade',
                'valor' => 50,
                'data' => $date,
            ];
        }
        else{
            
            $debetData = [
                'id_membro' => $memberData['id'],
                'referente' => 'Mensalidade',
                'valor' => 30,
                'data' => $date,
            ];
        }
    
        return [
            Divida::query()->create($debetData),
            UpdateDebtValueAction::execute($memberId)
        ];
    }
}
