<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;
    protected $guard = 'vendor';
    protected $fillable = ['shop_name', 'owner_name', 'contact_number', 'email', 'password', 'status'];
}
