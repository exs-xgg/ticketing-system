<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class muncity extends Model
{
    //
    protected $table='muncity';

    public $timestamps = false;
	protected $fillable = ['muncity'];

    public function user(){
    	$this->belongsTo('App\muncity');
    }
    
}
