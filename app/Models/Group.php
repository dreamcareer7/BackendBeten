<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Group
 *
 * @property int $id
 * @property string $title
 * @property int $crew_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GroupClients> $clients
 * @property-read int|null $clients_count
 * @property-read \App\Models\Crew|null $crew
 * @method static \Illuminate\Database\Eloquent\Builder|Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCrewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GroupClients> $clients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GroupClients> $clients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GroupClients> $clients
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GroupClients> $clients
 * @mixin \Eloquent
 */
class Group extends Model
{
	use HasFactory;

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	public function crew(){
		return $this->hasOne(Crew::class,'id','crew_id');
	}
	public function clients(){
		return $this->hasMany(GroupClients::class,'id','group_id');
	}
}
