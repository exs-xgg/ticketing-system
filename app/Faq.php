<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'prob_category',
        'sub_category',
        'problem',
        'solution',
    ];


}
