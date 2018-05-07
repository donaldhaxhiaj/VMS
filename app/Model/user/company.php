<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    public function companies()
    {
        return $this->belongsToMany('App\Model\user\visit','visit_companies')->withTimestamps();
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
