<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bridalcholi extends Model
{
    protected $table= 'bridalcholi';
    
    protected $fillable = [
        'choli_no',
        'choli_name',
        'rent_price',
        'photo',
    ];
}
