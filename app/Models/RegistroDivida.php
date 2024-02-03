<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroDivida extends Model
{
    use HasFactory;
    protected $table = 'registro_dividas';

    protected $fillable = [
        'id_membro',
        'total-divida',
        'ano',
    ];

    public function NomeMembro()
    {
        return $this->hasMany(Membro::class, 'id', 'id_membro');
    }

    public static function updateIdMember(int $id, array $attributes = []){
        return self::query()->where(['id_membro' => $id])->update($attributes);
    }

    public static function findByIdMembro(int $id){
        return self::query()->where( ['id_membro' => $id])->first();  
    }
}
