<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
        'birthDate',
        'email',
        'username',
        'password',
        'region',
        'province',
        'municipality',
        'facility'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function concern()
    {
        return $this->belongsToMany('App\Concern');
    }
 public function faq()
    {
        return $this->belongsToMany('App\Faq');
    }


}
