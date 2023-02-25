<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
 * @property-read \App\Models\Phase|null $phase
 * @property-read \App\Models\Service|null $service
 * @mixin \Eloquent
 */
class PhaseService extends Model
{
	public function service(): HasOne
	{
		return $this->hasOne(Service::class, 'id', 'service_id');
	}

	public function phase(): HasOne
	{
		return $this->hasOne(Phase::class, 'id', 'phase_id');
	}
}
