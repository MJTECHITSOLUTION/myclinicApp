<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posologie extends Model
{
    use HasFactory;
    protected $table = 'posologie';
    protected $guarded = [];
    public $timestamps = false;

}
