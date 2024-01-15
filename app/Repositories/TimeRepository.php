<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Time;


class TimeRepository extends AbstractRepository
{
    protected static $model = Time::class;

    // public static function findByEmail(string $email){
    //     return self::loadModel()::query()->where( ['email' => $email])->first();  
    // }
}