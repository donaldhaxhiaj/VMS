<?php

namespace App\Model\User;


use Illuminate\Database\Eloquent\Model;

class tag extends Model
{

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
