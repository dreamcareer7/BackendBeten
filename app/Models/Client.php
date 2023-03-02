<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $fullname Arabic language
 * @property int $country_id
 * @property string $id_type
 * @property string $id_no
 * @property int $gender 0->male, 1->female
 * @property int $is_handicap
 * @property string|null $phone
 * @property string|null $dob
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country|null $country
 * @method static \Illuminate\Database\Eloquent\Builder|Client countryName()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereIdNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereIdType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereIsHandicap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @property string $id_number
 * @property string $id_name
 * @method static \Database\Factories\ClientFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Client onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereIdName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Client withoutTrashed()
 * @mixin \Eloquent
 */
class Client extends Model
{
	use HasFactory, SoftDeletes;

	/*
	 * Scopes
	 */
	public function scopeCountryName($query)
	{
		return $query->addSelect(['country_name' => Country::select('name')
			->whereColumn('country_id', 'countries.id')
			->limit(1)
		]);
	}

	/*
	 * Get the country from which the client comes from.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function country(): BelongsTo
	{
		return $this->belongsTo(Country::class);
	}
}
