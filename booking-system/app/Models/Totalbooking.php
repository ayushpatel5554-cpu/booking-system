<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Totalbooking extends Model
{
    use HasFactory;

    // Use the actual table name
    protected $table = 'totalbookings';

    // Allow mass assignment for fields we insert
    protected $fillable = [
        'bill_no',
        'choli_no',
        'choli_name',
        'customer_name',
        'contact_number',
        'delivery_date',
        'return_date',
        'rent_price',
        'deposit_price',
        'photo',
    ];

    // If you do have created_at/updated_at columns set this true (default true).
    // public $timestamps = true;


    

    }
