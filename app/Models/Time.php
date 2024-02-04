<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    public static function TimesOrdenado(){
        return self::query()->orderBy('pontos', 'desc')->orderBy('gols sofridos')->get();
    }

    public static function updateId(int $id, array $attributes = [])
    {
        return self::query()->where(['id' => $id])->update($attributes);
    }
}
