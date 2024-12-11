<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDepose extends Model
{
    use HasFactory;

    protected $table = 'type_depose';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'note',

    ];
}
