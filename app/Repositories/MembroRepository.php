<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Membro;

class MembroRepository extends AbstractRepository
{
    protected static $model = Membro::class;

    public static function findByStatus(string $Status){
        return self::loadModel()::query()->where( ['status' => $Status])->orderBy('nome')->get();  
    }

    public static function findByNomeApelido(string $NomeApelido){
        return self::loadModel()::query()->where('status', '=', true)->where(function($query) use ($NomeApelido){
            $query->where('nome', 'like', '%' . $NomeApelido . '%')
            ->orWhere('apelido', 'like', '%' . $NomeApelido . '%');
        })->orderBy('nome')->get();
    }
}