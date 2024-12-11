<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapport_type extends Model
{
    protected $table = 'rapport_type';
    protected $fillable = ['id', 'label'];
}
