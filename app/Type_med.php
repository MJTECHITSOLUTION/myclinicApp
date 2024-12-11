<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_med extends Model
{
    use HasFactory;
    protected $table = 'med_type';
    protected $guarded = [];
    public $timestamps = false;

}
