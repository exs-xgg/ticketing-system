<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convo extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function to_user()
    {
        return $this->belongsTo('App\User', 'to_user_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function getLatestMessage()
    {
        return $this->hasMany('App\Message')->latest()->first();
    }
}
