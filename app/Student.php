<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'birthDate',
        'email',
        'username',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sections()
    {
        return $this->belongsToMany('App\Section')->where('isActive', true);;
    }
}
