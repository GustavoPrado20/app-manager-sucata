<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\RegistroDivida;

class RegistroDividaRepository extends AbstractRepository
{
    protected static $model = RegistroDivida::class;

    public static function findByIdMembro(int $id){
        return self::loadModel()::query()->where( ['id_membro' => $id])->first();  
    }

    public static function updateIdMembro(int $id, array $attributes = []):int{
        return self::loadModel()::query()->where(['id_membro' => $id])->update($attributes);
    }

    public static function atualizar(int $id_membro)
    {
        $dividasPendentes = DividaRepository::dividasPendentes($id_membro);

        $valorTotal = 0;

        foreach($dividasPendentes as $dividaPendente)
        {
            $valorTotal = $valorTotal + $dividaPendente['valor'];
        }

        return RegistroDividaRepository::updateIdMembro($id_membro, ['total-divida' => $valorTotal]);
    }
}