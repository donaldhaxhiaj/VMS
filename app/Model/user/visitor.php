<?php

namespace App\Model\user;


use Illuminate\Database\Eloquent\Model;

class visitor extends Model
{
    public function visits()
    {
        return $this->belongsToMany('App\Model\user\visit','visit_visitors');
    }

    protected $fillable = [
        'name', 'surname','email','phone','status'
    ];


}
