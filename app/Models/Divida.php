<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divida extends Model
{
    use HasFactory;

    protected $table = 'dividas';

    protected $fillable = [
        'id_membro',
        'referente',
        'valor',
        'data'
    ];

}
