<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasConcurrent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class ConcurrentRole extends Model
{
	use HasConcurrent, HasFactory, SoftDeletes;
}
