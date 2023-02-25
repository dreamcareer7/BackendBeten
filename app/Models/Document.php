<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

	// Available model types for documents
	public static $model_types = [
	  'App\Models\Contract',
	  'App\Models\Vehicles',
	  'App\Models\Crew',
	  'App\Models\User',
	  'App\Models\Meal',
	  'App\Models\Complaint',
	  // other than contract, for example location, terms, photos..etc
	  'App\Models\Dormitory',
	];
}
