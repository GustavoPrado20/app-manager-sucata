<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Despesa;
use Carbon\Carbon;

class DespesaRepository extends AbstractRepository
{
    protected static $model = Despesa::class;

    // public static function findByEmail(string $email){
    //     return self::loadModel()::query()->where( ['email' => $email])->first();  
    // }

    public static function JuizDespesaMes($mes)
    {
        return self::loadModel()::query()->where('referencia', '=', 'Juiz')->whereMonth('data', $mes)->get();
    }

    public static function outrasDespesaMes($mes)
    {
        return self::loadModel()::query()->where('referencia', '!=', 'Juiz')->whereMonth('data', $mes)->get();
    }

    public static function totalOutrasDespesasMes($mes)
    {
        $despesas = self::loadModel()::query()->where('referencia', '!=', 'Juiz')
        ->whereMonth('data', $mes)
        ->get();

        $total = 0;

        foreach($despesas as $despesa)
        {
            $total = $despesa['valor'] + $total;
        }

        return $total;
    }

    public static function despesaTotal()
    {
        $despesas = DespesaRepository::all();

        $despesaTotal = 0;

        foreach($despesas as $despesa)
        {
            $despesaTotal = $despesa['valor'] + $despesaTotal;
        }

        return $despesaTotal;
    }

}