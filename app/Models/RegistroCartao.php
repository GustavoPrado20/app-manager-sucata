<?php

namespace App\Models;

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
}
