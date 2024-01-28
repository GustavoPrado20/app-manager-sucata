<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\RegistroCartao;
use Carbon\Carbon;

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
        $dataHoje = Carbon::now();

        foreach($idJogadores as $idJogador)
        {
            $dados = ['id_jogador' => intval($idJogador), 'cor' => $cor];
            RegistroCartaoRepository::create($dados);

            if($cor == 'Amarelo')
            {
                $data = ['id_membro' => $idJogador, 'referente' => 'Cartão Amarelo', 'valor' => 20, 'data' => $dataHoje];
                DividaRepository::create($data);
            }
            else
            {
                $data = ['id_membro' => $idJogador, 'referente' => 'Cartão Vermelho', 'valor' => 25, 'data' => $dataHoje];
                DividaRepository::create($data);
            }

            RegistroDividaRepository::atualizar(intval($idJogador));
        }

        foreach($idJogadores as $idJogador)
        {
            $cartoes = RegistroCartaoRepository::findByCor('Amarelo', intval($idJogador))->count();

            MembroRepository::update(intval($idJogador), ['cartoes-amarelos' => $cartoes]);
        }

        return true;
    }
}