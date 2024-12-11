<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class FlashMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'is_seen',
    ];

    /**
     * Relationship to the User model.
     * Assuming each flash message belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
