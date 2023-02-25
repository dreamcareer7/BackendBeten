<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\{HasContract, HasDocuments};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Crew
 *
 * @property int $id
 * @property string $fullname name in arabic language
 * @property int $gender 0->male, 1->female
 * @property int|null $profession_id
 * @property int $country_id
 * @property string $phone
 * @property string $id_type
 * @property string $id_no
 * @property string $dob
 * @property int $is_active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contract|null $contract
 * @property-read \App\Models\Country|null $country
 * @method static \Illuminate\Database\Eloquent\Builder|Crew countryName()
 * @method static \Database\Factories\CrewFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Crew newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Crew newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Crew query()
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereIdNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereIdType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereProfessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Crew extends Model
{
	use HasContract, HasDocuments, HasFactory;

	/*
	 * Local Query scope
	 *
	 * @param $query
	 */
	public function scopeCountryName($query)
	{
		return $query->addSelect(['country_name' => Country::select('name')
					 ->whereColumn('country_id', 'countries.id')
					 ->limit(1)
		]);
	}

	/*
	 * Relationships
	 */
	public function country(): BelongsTo
	{
		return $this->belongsTo(Country::class);
	}

	/**
	 * Prepare a date for array / JSON serialization.
	 */
	protected function serializeDate(DateTimeInterface $date): string
	{
		return $date->format('Y-m-d H:i:s');
	}
}
