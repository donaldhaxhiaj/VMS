<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class visit extends Model
{

    public function visitors()
    {
        return $this->belongsToMany('App\Model\user\visitor','visit_visitors')->withTimestamps();
    }

    public function companies()
    {
        return $this->belongsToMany('App\Model\user\company','visit_companies');
    }


}
