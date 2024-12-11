<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gabarit extends Model
{
    protected $table = 'gabarit';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    use HasFactory;
}
