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

    public static function updateIdMember(int $id, array $attributes = []){
        return self::query()->where(['id_membro' => $id])->update($attributes);
    }
}
