<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'instructor_id',
        'course_id',
        'name',
    ];

    protected $dates = ['deleted_at'];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->orderBy('lastName', 'asc');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

    public function lessons()
    {
        return $this->belongsToMany('App\Lesson')->where('status', true);
    }

    public function quizzes()
    {
        return $this->belongsToMany('App\Quiz')->where('isActive', true);
    }

    public function assignments()
    {
        return $this->belongsToMany('App\Assignment')->where('isActive', true);
    }

    public function announcements()
    {
        return $this->belongsToMany('App\Announcement')->orderBy('updated_at', 'desc');
    }

    public function students()
    {
        return $this->belongsToMany('App\User', 'section_user');
    }

    public function instructor()
    {
        return $this->belongsTo('App\User');
    }

    public function takes()
    {
        return $this->hasMany('App\Take');
    }

    public function passes()
    {
        return $this->hasMany('App\Pass');
    }
}
