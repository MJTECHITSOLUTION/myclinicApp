<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class No extends Model
{
    use HasFactory;
    protected $table = 'act';
    protected $guarded = [];
    public $timestamps = false;

}
