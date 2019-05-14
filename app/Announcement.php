<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'instructor_id',
        'course_id',
        'section_id',
        'image',
        'message'
    ];

    public function instructor()
    {
        return $this->belongsTo('App\User');
    }

    public function sections()
    {
        return $this->belongsToMany('App\Section')->where('isActive', true);
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
