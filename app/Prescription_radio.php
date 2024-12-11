<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription_radio extends Model
{
    protected $table = 'prescription_radio';

    public function radio()
    {
        return $this->belongsTo('App\Radio', 'radio_id', 'radio_id');
    }
}
