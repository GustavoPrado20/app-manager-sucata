<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $table = 'receitas';

    protected $fillable = [
        'referencia',
        'valor',
        'data',
    ];

    public static function addRecipes(array $data)
    {
        $idsDividas = $data['id_dividas'];
        $valor = $data['valor'];

        $dataAtual = Carbon::now();

        foreach($idsDividas as $idDivida)
        {
            Divida::updateIdDebt(intval($idDivida),['situação' => 'Paga', 'data_paga' => $dataAtual]);
        }

        return  self::query()->create([
            'referencia' => 'Mensalidade/Falta/Cartão', 
            'valor' => $valor, 
            'data' => $dataAtual
        ]);
    }
}
