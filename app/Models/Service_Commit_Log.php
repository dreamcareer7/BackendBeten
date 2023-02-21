<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_Commit_Log extends Model
{
    use HasFactory;

    protected $table = 'service_commit_logs';

    protected $fillable = [
        'service_commit_id',
        'model_type',
        'model_id',
        'role',
        'created_at',
        'updated_at',
    ];
}
