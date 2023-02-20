<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    use HasFactory;
    protected $fillable=[
        'title' ,
        'phone' ,
        'country' ,
        'city_id' ,
        'location' ,
        'coordinate' ,
        'is_active' ,
    ];
}
