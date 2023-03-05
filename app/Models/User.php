<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\HasDocuments;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\{HasMany, HasOne};

class User extends Authenticatable
{
	use HasApiTokens, HasDocuments, HasFactory, HasRoles, Notifiable, SoftDeletes;

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_active' => 'boolean',
	];

	/**
	 * Prepare a date for array / JSON serialization.
	 *
	 * @return string date formatted
	 */
	protected function serializeDate(DateTimeInterface $date): string
	{
		return $date->format('Y-m-d H:i:s');
	}

	/**
	 * Get the crew member of the user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function crew(): HasOne
	{
		return $this->hasOne(related: Crew::class);
	}

	/**
	 * Get service commits assigned to the user (as supervisor).
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function service_commits(): HasMany
	{
		return $this->hasMany(ServiceCommit::class, 'supervisor_id');
	}
}
