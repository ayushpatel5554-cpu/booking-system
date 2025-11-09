<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allcholi extends Model
{
    // Explicit table name (if it doesn’t follow Laravel’s plural convention)
    protected $table = 'allcholi'; // Make sure this matches your DB table name

    // Allow mass assignment
    protected $fillable = [
        'choli_no',
        'choli_name',
        'rent_price',
        'photo',
    ];
}
