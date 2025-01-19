<?php

namespace App\Models;

use App\Actions\UpdateDebtValueAction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroCartao extends Model
{
    use HasFactory;

    protected $table = 'registro_cartoes';

    protected $fillable = [
        'id_jogador',
        'cor',
    ];

    public static function findByIdJogador(int $idJogador){
        return self::query()->where( ['id_jogador' => $idJogador])->get();  
    }

    public static function findByCor(string $cor, int $idJogador){
        return self::query()->where( ['id_jogador' => $idJogador])->where('cor', '=', $cor)->get();  
    }

    public static function regisrarCatao($data)
    {
        $cor = $data['cor'];
        $idJogadores = $data['jogador'];
        $dataHoje = Carbon::now();

        foreach($idJogadores as $idJogador)
        {
            $dados = ['id_jogador' => intval($idJogador), 'cor' => $cor];
            self::query()->create($dados);

            if($cor == 'Amarelo')
            {
                $data = ['id_membro' => $idJogador, 'referente' => 'Cartão Amarelo', 'valor' => 25, 'data' => $dataHoje];
                Divida::query()->create($data);
            }
            else
            {
                $data = ['id_membro' => $idJogador, 'referente' => 'Cartão Vermelho', 'valor' => 30, 'data' => $dataHoje];
                Divida::query()->create($data);
            }

            UpdateDebtValueAction::execute(intval($idJogador));
        }

        foreach($idJogadores as $idJogador)
        {
            $cartoes = self::findByCor('Amarelo', intval($idJogador))->count();

            Membro::updateId(intval($idJogador), ['cartoes-amarelos' => $cartoes]);
        }

        return true;
    }
}
