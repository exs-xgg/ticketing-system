<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Final extends Model
{
     protected $table = 'Final';
    protected $fillable = [
        'concern_id', 'note_receiver2'
    ];
}
