<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waiting_list extends Model
{
	protected $table = 'waiting_list';
	protected $guar=[];


	// public $dates = [ 'date'];


	 public function User(){
	        return $this->hasOne('App\User','id','user_id');
	    }
}
