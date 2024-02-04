<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;

    protected $table = 'membros';

    protected $fillable = [
        'nome',
        'apelido',
        'ocupação',
        'id_time',
        'gols',
        'faltas',
        'data-entrada-time',
        'status',
        'cartoes-amarelos',
        'acordo',
    ];

    public static function findByStatus(bool $status)
    {
        return self::query()->where('status','=', $status)->orderBy('nome')->get();
    }

    public static function findById(int $id){
        return self::query()->where('status', '=', true)->where('id', '=', $id)->first();
    }

    public static function updateId(int $id, array $attributes = [])
    {
        return self::query()->where(['id' => $id])->update($attributes);
    }

    public static function allJogadores()
    {
        return self::query()->where('status', '=', true)->where('id_time', '=', null)->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->orderBy('nome')->get();
    }

    public static function artilheiros()
    {
        return self::query()->where('status', '=', true)->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->where('id_time', '!=', null)->orderBy('gols', 'desc')->take(10)->get();
    }

    public static function findByNomeApelido(string $NomeApelido){
        return self::query()->where('status', '=', true)->where(function($query) use ($NomeApelido){
            $query->where('nome', 'like', '%' . $NomeApelido . '%')
            ->orWhere('apelido', 'like', '%' . $NomeApelido . '%');
        })->orderBy('nome')->get();
    }

    public static function jogadoresComCartoes()
    {
        return self::query()->where('status', '=', true)->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->where('id_time', '!=', null)->orderBy('cartoes-amarelos', 'desc')->take(10)->get();
    }

    public static function jogadoresTimes()
    {
        return self::query()->where('status', '=', true)->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->where('id_time', '!=', null)->orderBy('nome')->get();
    }

    public static function jogadoresTimeAzul()
    {
        return self::query()->where('id_time', '=', 1)->orderBy('nome')->get();
    }

    public static function jogadoresTimeVermelho()
    {
        return self::query()->where('id_time', '=', 2)->orderBy('nome')->get();
    }

    public static function adicionarJogadorTime(array $data)
    {
        $idTime = $data['time'];

        $idJogadores = $data['jogador'];
        
        foreach ($idJogadores as $idJogador){
           self::updateId(intval($idJogador), ['id_time' => $idTime]);
        }

        return true;
    }

    public static function registrarGols($data)
    {
        $idJogadores = $data['jogador'];
        $gols = $data['gols'];

        foreach ($idJogadores as $idJogador)
        {
            $dadosJogador = self::findById(intval($idJogador));
            self::updateId(intval($idJogador), ['gols' => ($gols + $dadosJogador['gols'])]);
        }

        return true;
    }

    public static function jogadoresSemAcordo()
    {
        return self::query()->where('status', '=', true)
        ->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })
        ->where('acordo', '=', false)
        ->orderBy('nome')
        ->get();
    }

    public static function sociosEAcordo()
    {
        return self::query()->where('status', '=', true)
        ->where(function($query){
            $query->where('ocupação', '=', 'Jogador')->where('acordo', '=', true)
            ->orWhere('ocupação', '=', 'Sócio');
        })
        ->orderBy('nome')
        ->get();
    }
}
