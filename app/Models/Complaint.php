<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaints';

    protected $fillable = [
        'title',
        'referfence',
        'commenter_model_type',
        'commenter_model_id',
        'upon_model_type',
        'upon_model_id',
        'comment',
        'created_by',
        'closed_by',
        'closed_at',
        'closed_comment',
    ];
}
