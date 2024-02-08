<?php

namespace App\Models;

use App\Actions\CalculateAbsencesPaidMonthAction;
use App\Actions\CalculateCardsPaidMonthAction;
use App\Actions\CalculateMonthlyPaymentsAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divida extends Model
{
    use HasFactory;

    protected $table = 'dividas';

    protected $fillable = [
        'id_membro',
        'referente',
        'valor',
        'data',
        'data_paga'
    ];

    public static function pendingDebts(int $memberId)
    {
        return self::query()->where('id_membro', '=', $memberId)
        ->where('situação', '=', 'Pendente')
        ->get();
    }

    public static function updateIdDebt(int $id, array $attributes = []){
        return self::query()->where(['id' => $id])->update($attributes);
    }

    public static function totalRevenue()
    {
        $receitas = self::query()->where('situação', '=', 'Paga')->get();

        $total = 0;

        foreach($receitas as $receita)
        {
            $total = $receita['valor'] + $total;
        }
        
        return $total;
    }

    public static function totalReceivedMonths()
    {
        $meses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $totalMeses = [];

        for($count = 0; $count < 12; $count ++)
        {
            $faltasPagas = CalculateAbsencesPaidMonthAction::execute($meses[$count]);
            $mensalidadesPagas = CalculateMonthlyPaymentsAction::execute($meses[$count]);
            $cartoesPagos = CalculateCardsPaidMonthAction::execute($meses[$count]);
            
            $totalMeses[$count] = htmlspecialchars(strval($faltasPagas + $mensalidadesPagas + $cartoesPagos), ENT_QUOTES, 'UTF-8');
        }

        return $totalMeses;
    }
}
