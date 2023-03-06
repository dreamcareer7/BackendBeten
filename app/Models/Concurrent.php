<?php

namespace App\Models;

use App\Models\Traits\HasConcurrent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Concurrent extends Model
{
    use HasFactory, SoftDeletes, HasConcurrent;
    public $timestamps = false;

    public static array $model_types = [
		Vehicle::class,
	];

}
