<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Record extends Model
{
    public function owner()
    {
        return $this->belongsTo('App\User', 'ahc_id');
    }

    public function speakers()
    {
        return $this->hasMany('App\Speaker');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');
    }

    public function words()
    {
        return $this->hasManyThrough(
            'App\Word',
            'App\Speaker',
            'record_id',
            'speaker_id',
            'id',
            'id'
        );
    }
}
