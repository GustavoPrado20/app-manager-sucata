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
}