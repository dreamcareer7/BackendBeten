<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Phase
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PhaseService> $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder|Phase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phase query()
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PhaseService> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PhaseService> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PhaseService> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PhaseService> $services
 * @property int|null $is_required
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PhaseService> $services
 * @method static \Illuminate\Database\Eloquent\Builder|Phase whereIsRequired($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PhaseService> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PhaseService> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PhaseService> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PhaseService> $services
 * @mixin \Eloquent
 */
class Phase extends Model
{
	use HasFactory;

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	protected $fillable=["title"];

	public function services(){
		return $this->hasMany(PhaseService::class,'id','phase_id');
	}
}
