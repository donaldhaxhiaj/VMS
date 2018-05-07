<?php

namespace App\Model\User;


use Illuminate\Database\Eloquent\Model;

class visitor extends Model
{
    public function visitors()
    {
        return $this->belongsToMany('App\Model\user\visit','visit_visitors')->withTimestamps();
    }

}
