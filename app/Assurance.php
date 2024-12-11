<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assurance extends Model
{
    protected $table = 'assurance';
    protected $fillable = ['assurance_name','generic_name','note'];

//    public function Prescription(){
//        return $this->hasMany('App\Prescription_assurance');
//    }

}
