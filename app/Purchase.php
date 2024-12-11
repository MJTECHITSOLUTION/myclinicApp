<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;



    // public function items() 

    // {
    //     return $this->belongsToMany(Item::class, 'purchase_item')
    //         ->withPivot('quantity') // had pivot hia tabele li kokon binathom
    //         ->withTimestamps(); // Add this if you want to include timestamps in the pivot table
    // }

    public function items()

    {

        return $this->belongsToMany(Item::class)
            ->withTimestamps() // Add this if you want to include timestamps in the pivot table
            ->withPivot('quantity'); // had pivot hia tabele li kokon binathom
    }
}
