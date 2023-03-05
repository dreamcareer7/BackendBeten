<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $title
 * @property string $city
 * @property string|null $before_date
 * @property string|null $exact_date
 * @property string|null $after_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereAfterDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereBeforeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereExactDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @property int $city_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Phase> $phases
 * @property-read int|null $phases_count
 * @method static \Database\Factories\ServiceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCityId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Phase> $phases
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Phase> $phases
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Phase> $phases
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Phase> $phases
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Phase> $phases
 * @mixin \Eloquent
 */
class Service extends Model
{
	use HasFactory;

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	public function city()
	{
		return $this->belongsTo(City::class, 'city_id');
	}

	/**
	 * The phases that belong to the service.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function phases(): BelongsToMany
	{
		return $this->belongsToMany(related: Phase::class);
	}
}
