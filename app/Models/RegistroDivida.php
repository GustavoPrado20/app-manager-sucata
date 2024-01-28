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
}
