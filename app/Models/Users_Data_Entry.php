<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDataEntry extends Model
{
    use HasFactory;

    protected $table = 'users_dataentry';

    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
        'method',
        'repository'
    ];
}
