<?php

namespace App\Models;

use App\Models\Traits\HasConcurrent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class ConcurrentRole extends Model
{
    use HasFactory, SoftDeletes, HasConcurrent;
}
