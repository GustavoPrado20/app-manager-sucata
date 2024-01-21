<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;

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
}
