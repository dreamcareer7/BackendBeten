<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasDocuments;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Contract
 *
 * @property int $id
 * @property string $url
 * @property int $contractable_id
 * @property string $contractable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read int|null $documents_count
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereContractableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereContractableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereUrl($value)
 * @mixin \Eloquent
 */
class Contract extends Model
{
	use HasDocuments;

	/** @var array $model_types Available model types for contracts */
	// This property is used for validation ATM
	public static array $model_types = [
		Crew::class,
		Vehicle::class,
		Dormitory::class,
	];

	// TODO: cast extra JSON column into an array if we end up adding it
}
