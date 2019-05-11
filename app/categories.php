<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    //
    protected $table='categories';

    public $timestamps = false;
	protected $fillable = ['categories'];

    public function user(){
    	$this->belongsTo('App\categories');
    }
    
}
