<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    // Available model types for contracts 
    protected $model_types = [
        'App\Models\Crew',
        'App\Models\Vehicles',
        'App\Models\Dormitory',
    ];
}
