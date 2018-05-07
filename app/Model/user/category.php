<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
