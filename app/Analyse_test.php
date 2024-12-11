<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class analyse_test extends Model
{

    protected $table = 'analyse_test';

    public function test(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\test', 'id', 'test_id');
    }
}
