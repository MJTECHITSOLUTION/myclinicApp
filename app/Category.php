<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categorys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
    ];


    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
