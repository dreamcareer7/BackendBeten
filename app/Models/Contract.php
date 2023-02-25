<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Contract
 *
 * @property int $id
 * @property string $reference
 * @property string $model_type
 * @property int $model_id
 * @property string|null $extra json conditions
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $contractable
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Contract extends Model
{
	/** @var array $model_types Available model types for contracts */
	// Note that this property is currently for documentation purposes only
	// It's not referenced or used anywhere in the codebase
	public static array $model_types = [
		Crew::class,
		Vehicle::class,
		Dormitory::class,
	];

	/**
	 * Get the parent contractable model (any of $this->model_types)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 **/
	public function contractable(): MorphTo
	{
		return $this->morphTo();
	}
}
