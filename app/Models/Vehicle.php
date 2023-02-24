<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory, HasContract;
}
