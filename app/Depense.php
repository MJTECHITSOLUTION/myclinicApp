<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;


    protected $table = 'depenses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'label',
        'type_depenses',
        'monton',
        'created_by',
        'note',


    ];
}
