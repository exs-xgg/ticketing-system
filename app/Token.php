<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Section;
use App\Course;

class Token extends Model
{
    protected $fillable = [
        'instructor_id',
        'section_id',
        'token',
        'status'
    ];

    public function section()
    {
        return $this->belongsTo('App\Section')->where('isActive', true);;
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
