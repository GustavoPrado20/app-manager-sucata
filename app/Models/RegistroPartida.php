<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroPartida extends Model
{
    use HasFactory;

    protected $table = 'registro_partidas';

    protected $fillable = [
        'resultado',
        'placar',
        'data-partida',
    ];

    public static function findByResultado(string $resultado){
        return self::query()->where( ['resultado' => $resultado])->get();  
    }

    public static function registrarPartida($dados)
    {
        $data = ['resultado' => $dados['resultado'], 'placar' => $dados['placar'], 'data-partida' => $dados['data']];
        $registrarPartida = self::query()->create($data);

        if ($registrarPartida)
        {
            $dadosTimeAzul = Time::query()->find(1);
            $dadosTimeVermelho = Time::query()->find(2);

            $vitoriasAzul = self::findByResultado('Time Azul')->count();
            $vitoriasVermelho = self::findByResultado('Time Vermelho')->count();
            $empates = self::findByResultado('Empate')->count();

            Time::updateId($dadosTimeAzul['id'], ['pontos' => (($vitoriasAzul * 3) + ($empates * 1))]);
            Time::updateId($dadosTimeVermelho['id'], ['pontos' => (($vitoriasVermelho * 3) + ($empates * 1))]);

            $placar = str_split($data['placar']);

            Time::updateId($dadosTimeAzul['id'], ['gols marcados' => (intval($placar[0]) + $dadosTimeAzul['gols marcados'])]);
            Time::updateId($dadosTimeVermelho['id'], ['gols sofridos' => (intval($placar[0]) + $dadosTimeVermelho['gols sofridos'])]);

            Time::updateId($dadosTimeAzul['id'], ['gols sofridos' => (intval($placar[4]) + $dadosTimeAzul['gols sofridos'])]);
            Time::updateId($dadosTimeVermelho['id'], ['gols marcados' => (intval($placar[4]) + $dadosTimeVermelho['gols marcados'])]);

            return true;
        }
    }

    public static function ultimosJogos()
    {
        return self::query()->orderBy('data-partida', 'desc')->take(4)->get();
    }
}
