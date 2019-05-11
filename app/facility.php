<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facility extends Model
{
    //
    protected $table='facility';

    public $timestamps = false;
	protected $fillable = ['facility'];

    public function user(){
    	$this->belongsTo('App\facility');
    }
    
}
