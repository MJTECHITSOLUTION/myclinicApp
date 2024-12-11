<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription_medicament extends Model
{

	    protected $table = 'prescription_medicament';

     public function Drug(){
    	        return $this->hasOne('App\Drug', 'id', 'drug_id');
    }
}
