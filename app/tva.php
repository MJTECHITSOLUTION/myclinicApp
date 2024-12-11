<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tva extends Model
{
    use HasFactory;



    protected $table = 'tva';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'value',

    ];
}
