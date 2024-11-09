<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    //

    protected $fillable = [
        'user_id',
        'product_id',
        'total_price',
        'transaction_date',
    ];
}
