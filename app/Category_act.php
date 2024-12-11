<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_act extends Model
{
    use HasFactory;
    protected $table = 'category_act';
    protected $guarded = [];
    public $timestamps = false;


}
