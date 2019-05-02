<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'admin_id',
        'concern_id',
        'image',
        'message'
    ];

    public function admin()
    {
        return $this->belongsTo('App\User');
    }

    public function sections()
    {
        return $this->belongsToMany('App\Section')->where('isActive', true);
    }

    public function concern()
    {
        return $this->belongsTo('App\Concern');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
