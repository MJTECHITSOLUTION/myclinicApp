<?php

namespace App;

use App\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'price',
        'purchase_price',
        'sale_price',
        'brand',
        'category_id',
        'unit',
        'expiration_date',
        'production_date',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function purchases()
    // {
    //     return $this->belongsToMany(Purchase::class, 'purchase_item')
    //         ->withPivot('quantity')
    //         ->withTimestamps(); // Add this if you want to include timestamps in the pivot table
    // }

    public function purchases()
    {
        // 1 purchase belongs to many items (the id of the purchase is "id" in the purchase table)
        return $this->belongsToMany(Purchase::class)
            ->withTimestamps(); // Add this if you want to include timestamps in the pivot table
    }
}
