<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Service_Commit
 *
 * @property int $id
 * @property int $service_id
 * @property string $badge
 * @property \Illuminate\Support\Carbon|null $scheduled_at
 * @property \Illuminate\Support\Carbon|null $started_at
 * @property string $location
 * @property int|null $supervisor_id crew_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Service|null $service
 * @property-read \App\Models\Service_Commit_Log|null $service_commit_log
 * @property-read \App\Models\Crew|null $supervisor
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit whereBadge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit whereScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit whereSupervisorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service_Commit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
	 * Get the supervisor crew member of the service commit
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 **/
	public function supervisor(): BelongsTo
	{
		return $this->belongsTo(Crew::class, 'supervisor_id');
	}
}
