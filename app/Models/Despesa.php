<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;

    protected $table = 'despesas';

    protected $fillable = [
        'referencia',
        'valor',
        'data'
    ];

    public static function JuizDespesaMes($mes)
    {
        $despesas = self::query()->where('referencia', '=', 'Juiz')->whereMonth('data', $mes)->get();
        $valorTotal = 0;

        foreach($despesas as $despesa)
        {
            $valorTotal += $despesa['valor'];
        }

        return $valorTotal;
    }

    public static function outrasDespesaMes($mes)
    {
        return self::query()->where('referencia', '!=', 'Juiz')->whereMonth('data', $mes)->get();
    }

    public static function totalOutrasDespesasMes($mes)
    {
        $despesas = self::query()->where('referencia', '!=', 'Juiz')
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
        $despesas = self::all();

        $despesaTotal = 0;

        foreach($despesas as $despesa)
        {
            $despesaTotal = $despesa['valor'] + $despesaTotal;
        }

        return $despesaTotal;
    }
}
