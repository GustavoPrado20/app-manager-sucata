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
}
