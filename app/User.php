<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function courses()
    {
        return $this->belongsToMany('App\Course')->where('status', true)->latest();
    }
     public function users()
    {
        return $this->belongsToMany('App\User')->where('status', true)->latest();
    }

    public function sections()
    {
        return $this->belongsToMany('App\Section')->where('isActive', true)->whereHas('course', function($e){
            $e->where('status', true);
        });
    }

    public function instructorSections()
    {
        return $this->hasMany('App\Section', 'instructor_id');
    }

    public function announcements()
    {
        return $this->hasMany('App\Announcement');
    }

    public function convos()
    {
        return $this->hasMany('App\Convo');
    }

    public function messages()
    {
        return $this->hasMany('App\Mesage');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function takes()
    {
        return $this->hasMany('App\Take');
    }

    public function takesQuiz($quiz_id)
    {
        return $this->hasMany('App\Take')->where('quiz_id', $quiz_id)->first();
    }

    public function passesExport($assignment_id)
    {
        return $this->hasMany('App\Pass')->where('assignment_id', $assignment_id)->first();
    }

    public function passes()
    {
        return $this->hasMany('App\Pass');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function quizzes()
    {
        return $this->hasMany('App\User');
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

    public function name()
    {
        if($this->suffixName != ''){
            return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName) . ' ' . ucfirst($this->suffixName);
        } else {
            return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName);
        }
    }

    public function lastFirstName()
    {
        if($this->suffixName != ''){
            return ucfirst($this->lastName) . ', ' . ucfirst($this->firstName) . ' ' . ucfirst($this->middleName). ' ' . ucfirst($this->suffixName);
        } else {
            return ucfirst($this->lastName) . ', ' . ucfirst($this->firstName) . ' ' . ucfirst($this->middleName);
        }
    }
}


// $user->courses()->detach();
// $user->sections()->delete();
// $user->announcements()->delete();
// $user->lessons()->delete();
// $user->quizzes()->delete();
// $user->tokens()->delete();
// $user->files()->delete();
// $user->convos()->delete();
// $user->convos()->delete();
// $user->assignments()->delete();
// $user->takes()->delete();
// $user->passes()->delete();
