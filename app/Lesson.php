<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
      'instructor_id',
      'course_id',
      'title',
      'description',
      'status'
    ];

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
