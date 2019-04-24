<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concerns2 extends Model
{
	protected $table = 'concern2';
    protected $fillable = 
    [
    	'id',
    	'concern_id',
    	'receiver2',
    	'priority',
    	'status',
    	'remark'
    ];
}
