<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing_cheque extends Model
{
    use HasFactory;
    protected $table = 'billing_cheque';
    public $timestamps = false;

}
