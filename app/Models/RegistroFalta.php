<?php

namespace App\Models;

use App\Actions\UpdateDebtValueAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroFalta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jogador',
        'motivo',
        'data',
    ];

    public static function findByIdJogador(int $idJogador){
        return self::query()->where( ['id_jogador' => $idJogador])->get();  
    }

    public static function findFaltasCobradas(int $idJogador){
        return self::query()->where( ['id_jogador' => $idJogador])->where(function($query){
            $query->where('motivo', '=', 'Não Justificado')->orWhere('motivo', '=', 'Atraso');
        })->get();  
    }

    public static function registrarFalta($dados)
    {
        $date = date('Y-m-d', strtotime($dados['data']));
        $motivo = $dados['motivo'];
        $idJogadores = $dados['jogador'];

        foreach ($idJogadores as $idJogador)
        {
            // $dadosFaltas = ['data' => $data, 'motivo' => $motivo, 'id_jogador' => $idJogador];
            self::query()->create([
                'data' => $date,
                'motivo' => $motivo,
                'id_jogador' => $idJogador
            ]);

            if($motivo == 'Atraso' or $motivo == 'Não Justificado')
            {
                $data = ['id_membro' => $idJogador, 'referente' => 'Falta', 'valor' => 40, 'data' => $date];
                Divida::query()->create($data);
            }

            UpdateDebtValueAction::execute(intval($idJogador));
        }

        foreach($idJogadores as $idJogador)
        {
            $faltas = ['faltas' => self::findByIdJogador(intval($idJogador))->count()];
            Membro::updateId(intval($idJogador), $faltas);
        }
        
        return true;
    }
}
