<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TakeAnswer extends Model
{
    protected $fillable = ['user_id', 'take_id', 'question_id', 'option', 'correct'];
}
