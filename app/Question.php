<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = ['id'];

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }
}
