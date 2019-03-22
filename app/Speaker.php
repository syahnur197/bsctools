<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $guarded = [];

    public function record()
    {
        return $this->belongsTo('App\Record');
    }

    public function words()
    {
        return $this->hasMany('App\Word');
    }
}
