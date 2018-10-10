<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class visit extends Model
{

    public function visitors()
    {
        return $this->belongsToMany('App\Model\user\visitor','visit_visitors')->withTimestamps();
    }

    public function company()
    {
        return $this->hasOne('App\Model\user\company','id','company_id');
    }


}
