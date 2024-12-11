<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Croissance  extends Model
{
    protected $table = 'croissance';

    protected $primaryKey = 'id';

    // Define the columns that are fillable
    protected $fillable = [
        'user_id',
        'x',
        'y',
        'graph_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);

    }
    public function graph()
    {
        return $this->belongsTo(Graph::class);
    }

}


