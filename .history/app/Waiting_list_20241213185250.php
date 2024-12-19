<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waiting_list extends Model
{
	protected $table = 'waiting_list';
	protected $fillable=['id','name','price','created_at','updated_at'];


	// public $dates = [ 'date'];


	 public function User(){
	        return $this->hasOne('App\User','id','user_id');
	    }
}
