<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table="documents";
    protected $fillable=[
      "title",
      "path",
      "model_type",
      "model_id",
      "uploaded_by",
     ];

    // Available model types for documents
    protected $model_types = [
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
