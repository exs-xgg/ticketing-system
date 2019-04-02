<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    protected $guarded = [
        'id'
      ];

    public function assignment()
    {
        return $this->belongsTo('App\Assignment');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
