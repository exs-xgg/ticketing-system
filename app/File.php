<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',
        'type',
        'size'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
