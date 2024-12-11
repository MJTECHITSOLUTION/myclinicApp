<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $table = 'fournisseurs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id ',
        'phone',
        'mobile',
        'Numéro_IF',
        'ICE',
        'Pays',
        'Ville',
        'Adresse',
    ];
}
