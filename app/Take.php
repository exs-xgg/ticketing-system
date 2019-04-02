<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Take extends Model
{
    protected $guarded = ['id'];

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }

    public function assignment()
    {
        return $this->belongsToMany('App\Assignment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
