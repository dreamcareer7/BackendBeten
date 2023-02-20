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
      "document_type",
      "description",
    ];
}
