<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\RegistroPartida;

class RegistroPartidaRepository extends AbstractRepository
{
    protected static $model = RegistroPartida::class;

    public static function findByResultado(string $resultado){
        return self::loadModel()::query()->where( ['resultado' => $resultado])->get();  
    }

    public static function registrarPartida($dados)
    {
        $data = ['resultado' => $dados['resultado'], 'placar' => $dados['placar'], 'data-partida' => $dados['data']];
        $registrarPartida = RegistroPartidaRepository::create($data);

        if ($registrarPartida)
        {
            $dadosTimeAzul = TimeRepository::find(1);
            $dadosTimeVermelho = TimeRepository::find(2);

            $vitoriasAzul = RegistroPartidaRepository::findByResultado('Time Azul')->count();
            $vitoriasVermelho = RegistroPartidaRepository::findByResultado('Time Vermelho')->count();
            $empates = RegistroPartidaRepository::findByResultado('Empate')->count();

            TimeRepository::update($dadosTimeAzul['id'], ['pontos' => (($vitoriasAzul * 3) + ($empates * 1))]);
            TimeRepository::update($dadosTimeVermelho['id'], ['pontos' => (($vitoriasVermelho * 3) + ($empates * 1))]);

            $placar = str_split($data['placar']);

            TimeRepository::update($dadosTimeAzul['id'], ['gols marcados' => (intval($placar[0]) + $dadosTimeAzul['gols marcados'])]);
            TimeRepository::update($dadosTimeVermelho['id'], ['gols sofridos' => (intval($placar[0]) + $dadosTimeVermelho['gols sofridos'])]);

            TimeRepository::update($dadosTimeAzul['id'], ['gols sofridos' => (intval($placar[4]) + $dadosTimeAzul['gols sofridos'])]);
            TimeRepository::update($dadosTimeVermelho['id'], ['gols marcados' => (intval($placar[4]) + $dadosTimeVermelho['gols marcados'])]);

            return true;
        }
    }

    public static function ultimosJogos()
    {
        return self::loadModel()::query()->orderBy('data-partida', 'desc')->take(4)->get();
    }
}