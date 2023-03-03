<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceCommit extends Model
{
	use HasFactory;

	/**
	 * The name of the "updated at" column.
	 *
	 * @var string|null
	 */
	const UPDATED_AT = null;

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'schedule_at' => 'datetime',
		'started_at' => 'datetime',
	];

	/**
	 * Prepare a date for array / JSON serialization.
	 */
	protected function serializeDate(DateTimeInterface $date): string
	{
		return $date->format('Y-m-d H:i:s');
	}

	/**
	 * Get the service this commit belongs to
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function service(): BelongsTo
	{
		return $this->belongsTo(Service::class);
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

	public function service_commit_log()
	{
		return $this->hasMany(Service_Commit_Log::class, 'service_commit_id', 'id');
	}
}
