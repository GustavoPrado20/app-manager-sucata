<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\RegistroCartao;

class RegistroCartaoRepository extends AbstractRepository
{
    protected static $model = RegistroCartao::class;

    public static function findByIdJogador(int $idJogador){
        return self::loadModel()::query()->where( ['id_jogador' => $idJogador])->get();  
    }

    public static function findByCor(string $cor, int $idJogador){
        return self::loadModel()::query()->where( ['id_jogador' => $idJogador])->where('cor', '=', $cor)->get();  
    }

    public static function regisrarCatao($data)
    {
        $cor = $data['cor'];
        $idJogadores = $data['jogador'];

        foreach($idJogadores as $idJogador)
        {
            $dados = ['id_jogador' => intval($idJogador), 'cor' => $cor];
            RegistroCartaoRepository::create($dados);
        }

        foreach($idJogadores as $idJogador)
        {
            $cartoes = RegistroCartaoRepository::findByCor('Amarelo', intval($idJogador))->count();

            MembroRepository::update(intval($idJogador), ['cartoes-amarelos' => $cartoes]);
        }

        return true;
    }
}