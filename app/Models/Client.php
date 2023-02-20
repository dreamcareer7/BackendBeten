<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable=[
        'fullname',
        'gender',
        'country_id',
        'phone',
        'id_type',
        'id_no',
        'dob'
    ];
}
