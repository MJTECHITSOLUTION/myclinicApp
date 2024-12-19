<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waiting_list extends Model
{
	protected $table = 'appointments';

	public $dates = [ 'date'];


	 public function User(){
	        return $this->hasOne('App\User','id','user_id');
	    }
}