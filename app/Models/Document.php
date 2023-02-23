<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    // Available model types for documents
    public static $model_types = [
      'App\Models\Contract',
      'App\Models\Vehicles',
      'App\Models\Crew',
      'App\Models\User',
      'App\Models\Meal',
      'App\Models\Complaint',
      // other than contract, for example location, terms, photos..etc
      'App\Models\Dormitory',
    ];
}
