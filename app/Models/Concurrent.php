<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Concurrent extends Model
{
	use HasFactory;

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'concurrent';

	/** @var array $model_types Available model types for concurrents */
	// This property is used for validation ATM
	public static array $model_types = [
		Meal::class,
		Service::class,
	];
}
