<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    use HasFactory;



    protected $table = 'variable';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
