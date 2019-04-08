<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concern extends Model
{
    protected $fillable = [
        'ticket',
        'receiver1',
        'receiver2',
        'reporter',
        'problem',
        'prob_category',
        'sub-category',
        'problem',
        'before',
        'priority',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

   
}
