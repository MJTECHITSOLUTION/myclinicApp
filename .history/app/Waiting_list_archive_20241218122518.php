<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class waiting_list_archive extends Model
{
    protected $table = 'waiting_list_archive';
    protected $guarded = [];

    // public $dates = ['date'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
