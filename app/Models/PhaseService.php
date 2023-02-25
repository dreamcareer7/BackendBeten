<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\PhaseService
 *
 * @property int $id
 * @property int $phase_id
 * @property int $service_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PhaseService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhaseService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhaseService query()
 * @method static \Illuminate\Database\Eloquent\Builder|PhaseService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhaseService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhaseService wherePhaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhaseService whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhaseService whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PhaseService extends Model
{
	use HasFactory;
	protected $fillable=[
		"phase_id","service_id"
	];

	public function service(){
		return $this->hasOne('services','id','service_id');
	}
	public function phase(){
		return $this->hasOne('phases','id','phase_id');

	}
}
