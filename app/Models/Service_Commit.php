<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service_Commit extends Model
{
    use HasFactory;

    protected $table = 'service_commits';

    protected $fillable = [
        'service_id',
        'badge',
        'schedule_at',
        'started_at',
        'from_location',
        'supervisor_id',
        'from_location',
        'created_at',
    ];

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    public function service_commit_log()
    {
        return $this->hasOne(Service_Commit_Log::class, 'service_commit_id', 'id');
    }

    /**
     * Service commit supervisor
     *
     * Get the supervisor user of the service commit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}
