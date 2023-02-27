<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\{HasContracts, HasDocuments};
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Dormitory
 *
 * @property int $id
 * @property string $title
 * @property string $phone
 * @property \App\Models\Country|null $country
 * @property string $city_id
 * @property string $location
 * @property string|null $coordinate json of geometry
 * @property int $is_active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory countryName()
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory whereCoordinate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory whereUpdatedAt($value)
 * @property string $phones
 * @property-read \App\Models\Contract|null $contract
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read int|null $documents_count
 * @method static \Database\Factories\DormitoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Dormitory wherePhones($value)
 * @mixin \Eloquent
 */
class Dormitory extends Model
{
	use HasContracts, HasDocuments, HasFactory;

	/*
	* Scopes
	*/
	public function scopeCountryName($query)
	{
		return $query->addSelect(['country_name' => Country::select('name')
			->whereColumn('country', 'countries.id')
			->limit(1)
		]);
	}

	/*
	 * Relationships
	 */

	public function country()
	{
		return $this->belongsTo(Country::class, 'id', 'country');
	}
}
