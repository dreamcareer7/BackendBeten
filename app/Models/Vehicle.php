<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\{HasContracts, HasDocuments};
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Vehicle
 *
 * @property int $id
 * @property string $model
 * @property string $manufacturer
 * @property string $year
 * @property string $registration
 * @property int $badge
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contract> $contracts
 * @property-read int|null $contracts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read int|null $documents_count
 * @method static \Database\Factories\VehicleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBadge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereManufacturer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereRegistration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereYear($value)
 * @mixin \Eloquent
 */
class Vehicle extends Model
{
	use HasContracts, HasDocuments, HasFactory;
}
