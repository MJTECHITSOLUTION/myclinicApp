<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    protected $fillable=['user_id','rapport_type_id','date_debut','date_fin','tuteur','nb_jour','child','libre','nb_jour1','name_medcien','verifie','patient_mariage','patient_cin','conclusion'];
    protected $table = 'rapport';
    public function rapportType()
{
    return $this->belongsTo(Rapport_type::class, 'rapport_type_id');
}
}

