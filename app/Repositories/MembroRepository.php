<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Membro;

class MembroRepository extends AbstractRepository
{
    protected static $model = Membro::class;

    public static function findByStatus(bool $Status){
        return self::loadModel()::query()->where( ['status' => $Status])->orderBy('nome')->get();  
    }

    public static function findByNomeApelido(string $NomeApelido){
        return self::loadModel()::query()->where('status', '=', true)->where(function($query) use ($NomeApelido){
            $query->where('nome', 'like', '%' . $NomeApelido . '%')
            ->orWhere('apelido', 'like', '%' . $NomeApelido . '%');
        })->orderBy('nome')->get();
    }

    public static function findById(int $id){
        return self::loadModel()::query()->where('status', '=', true)->where('id', '=', $id)->first();
    }

    public static function allJogadores()
    {
        return self::loadModel()::query()->where('status', '=', true)->where('id_time', '=', null)->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->orderBy('nome')->get();
    }

    public static function artilheiros()
    {
        return self::loadModel()::query()->where('status', '=', true)->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->where('id_time', '!=', null)->orderBy('gols', 'desc')->take(10)->get();
    }

    public static function jogadoresComCartoes()
    {
        return self::loadModel()::query()->where('status', '=', true)->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->where('id_time', '!=', null)->orderBy('cartoes-amarelos', 'desc')->take(10)->get();
    }

    public static function jogadoresTimes()
    {
        return self::loadModel()::query()->where('status', '=', true)->where(function($query){
            $query->where('ocupação', '=', 'Jogador')
            ->orWhere('ocupação', '=', 'Diretor e Jogador');
        })->where('id_time', '!=', null)->orderBy('nome')->get();
    }

    public static function jogadoresTimeAzul()
    {
        return self::loadModel()::query()->where('id_time', '=', 1)->orderBy('nome')->get();
    }

    public static function jogadoresTimeVermelho()
    {
        return self::loadModel()::query()->where('id_time', '=', 2)->orderBy('nome')->get();
    }

    public static function adicionarJogadorTime(array $data)
    {
        $idTime = $data['time'];

        $idJogadores = $data['jogador'];
        
        foreach ($idJogadores as $idJogador){
           MembroRepository::update(intval($idJogador), ['id_time' => $idTime]);
        }

        return true;
    }

    public static function registrarGols($data)
    {
        $idJogadores = $data['jogador'];
        $gols = $data['gols'];

        foreach ($idJogadores as $idJogador)
        {
            $dadosJogador = MembroRepository::find(intval($idJogador));
            MembroRepository::update(intval($idJogador), ['gols' => ($gols + $dadosJogador['gols'])]);
        }

        return true;
    }

    public static function jogadoresSemAcordo()
    {
        return self::loadModel()::query()->where('status', '=', true)
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
        return self::loadModel()::query()->where('status', '=', true)
        ->where(function($query){
            $query->where('ocupação', '=', 'Jogador')->where('acordo', '=', true)
            ->orWhere('ocupação', '=', 'Sócio');
        })
        ->orderBy('nome')
        ->get();
    }
}