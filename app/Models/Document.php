<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property string $title
 * @property string $path
 * @property string $model_type
 * @property int $model_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $document_type
 * @property string|null $description
 * @property int|null $uploaded_by
 * @method static \Illuminate\Database\Eloquent\Builder|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUploadedBy($value)
 * @mixin \Eloquent
 */
class Document extends Model
{
	use HasFactory;

	/** @var array $model_types Available model types for contracts */
	// Note that this property is currently for documentation purposes only
	// It's not referenced or used anywhere in the codebase
	public static array $model_types = [
		Contract::class,
		Vehicle::class,
		Crew::class,
		User::class,
		Meal::class,
		Complaint::class,
		// other than contract, for example location, terms, photos..etc
		Dormitory::class,
	];

	/**
	 * Get the parent documentable model (any of $this->model_types).
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function documentable(): MorphTo
	{
		return $this->morphTo();
	}
}
