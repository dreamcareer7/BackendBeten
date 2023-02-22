<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service_Commit extends Model
{
    use HasFactory;

    protected $table = 'service_commits';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'scheduled_at' => 'datetime',
        'started_at' => 'datetime',
    ];

    /**
     * Prepare a date for array / JSON serialization.
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

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
