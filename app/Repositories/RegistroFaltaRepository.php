<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\RegistroFalta;
use App\Models\Time;


class RegistroFaltaRepository extends AbstractRepository
{
    protected static $model = RegistroFalta::class;

    public static function findByIdJogador(int $idJogador){
        return self::loadModel()::query()->where( ['id_jogador' => $idJogador])->get();  
    }

    public static function findFaltasCobradas(int $idJogador){
        return self::loadModel()::query()->where( ['id_jogador' => $idJogador])->where(function($query){
            $query->where('motivo', '=', 'Não Justificado')->orWhere('motivo', '=', 'Atraso');
        })->get();  
    }

    public static function registrarFalta($dados)
    {
        $data = date('Y-m-d', strtotime($dados['data']));
        $motivo = $dados['motivo'];
        $idJogadores = $dados['jogador'];

        foreach ($idJogadores as $idJogador)
        {
            $dadosFaltas = ['data' => $data, 'motivo' => $motivo, 'id_jogador' => $idJogador];
            RegistroFaltaRepository::create($dadosFaltas);

            if($motivo == 'Atraso' or $motivo == 'Não Justificado')
            {
                $data = ['id_membro' => $idJogador, 'referente' => 'Falta', 'valor' => 30, 'data' => $data];
                DividaRepository::create($data);
            }

            RegistroDividaRepository::atualizar(intval($idJogador));
        }

        foreach($idJogadores as $idJogador)
        {
            $faltas = ['faltas' => RegistroFaltaRepository::findByIdJogador(intval($idJogador))->count()];
            MembroRepository::update(intval($idJogador), $faltas);
        }
        
        return true;
    }
}