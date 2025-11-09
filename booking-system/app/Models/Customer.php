<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    // Allow mass assignment
    protected $fillable = [
        'customer_name',
        'contact_number'
    ];
}
