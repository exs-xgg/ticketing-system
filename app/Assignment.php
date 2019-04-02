<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $guarded = [
      'id'
    ];

    protected $dates = ['expireDate', 'startDate'];

    public function sections()
    {
        return $this->belongsToMany('App\Section')->where('isActive', true);;
    }

    public function questions()
    {
        return $this->hasMany('App\Question')->inRandomOrder();
    }

    public function checkpasses($section_id)
    {
        return $this->hasMany('App\Pass')->where('user_id', auth()->user()->id)->where('section_id', $section_id)->first();
    }

    public function passes($section_id, $student_id)
    {
        return $this->hasMany('App\Pass')->where('user_id', $student_id)->where('section_id', $section_id)->first();
    }

    public function pass()
    {
        return $this->hasMany('App\Pass');
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
