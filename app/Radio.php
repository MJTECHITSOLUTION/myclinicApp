<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{

    protected $table = 'radio';
    protected $fillable = ['id','radio_name','description','created_at','updated_at'];

}
