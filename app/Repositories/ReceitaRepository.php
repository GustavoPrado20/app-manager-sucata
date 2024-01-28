<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Divida;
use App\Models\Receita;
use Carbon\Carbon;

class ReceitaRepository extends AbstractRepository
{
    protected static $model = Receita::class;

    // public static function findByEmail(string $email){
    //     return self::loadModel()::query()->where( ['email' => $email])->first();  
    // }

    public static function adicionarReceita(array $data)
    {
        $idsDividas = $data['id_dividas'];
        $valor = $data['valor'];

        $dataAtual = Carbon::now();

        foreach($idsDividas as $idDivida)
        {
            DividaRepository::update(intval($idDivida),['situação' => 'Paga']);
        }

        return  ReceitaRepository::create(['referencia' => 'Mensalidade/Falta/Cartão', 'valor' => $valor, 'data' => $dataAtual]);
    }
}