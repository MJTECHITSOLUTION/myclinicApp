<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{
    protected $table = 'graph';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type',
        'tranch_age',
        'sexe',
        'image',
        'label',
    ];

    use HasFactory;
}
