<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Divida;

class DividaRepository extends AbstractRepository
{
    protected static $model = Divida::class;

    public static function findById(int $id){
        return self::loadModel()::query()->where( ['id' => $id])->first();  
    }

    public static function dividasPendentes(int $id_membro)
    {
        return self::loadModel()::query()->where('id_membro', '=', $id_membro)->where('situação', '=', 'Pendente')->get();
    }

    public static function FaltasPagaMes($mes)
    {
        return self::loadModel()::query()->where('situação', '=', 'Paga')->whereMonth('data', $mes)->where('referente', '=', 'Falta')->get();
    }

    public static function MensalidadesPagaJaneiro($mes)
    {
        return self::loadModel()::query()->where('situação', '=', 'Paga')->whereMonth('data', $mes)->where('referente', '=', 'Mensalidade')->where('valor', '=', 10)->get();
    }

    public static function MensalidadesJogadoresPagaMes($mes)
    {
        return self::loadModel()::query()->where('situação', '=', 'Paga')->whereMonth('data', $mes)->where('referente', '=', 'Mensalidade')->where('valor', '=', 40)->get();
    }

    public static function MensalidadesSociosPagaMes($mes)
    {
        return self::loadModel()::query()->where('situação', '=', 'Paga')->whereMonth('data', $mes)->where('referente', '=', 'Mensalidade')->where('valor', '=', 20)->get();
    }

    public static function CartaoAmareloPagaMes($mes)
    {
        return self::loadModel()::query()->where('situação', '=', 'Paga')->whereMonth('data', $mes)->where('referente', '=', 'Cartão Amarelo')->get();
    }

    public static function CartaoVermelhoPagaMes($mes)
    {
        return self::loadModel()::query()->where('situação', '=', 'Paga')->whereMonth('data', $mes)->where('referente', '=', 'Cartão Vermelho')->get();
    }

    public static function dividasPagas()
    {
        return self::loadModel()::query()->where('situação', '=', 'Paga')->get();
    }

    public static function dividasTotal()
    {
        return self::loadModel()::query()->where('referente', '!=', 'Mensalidade')->get();
    }
}