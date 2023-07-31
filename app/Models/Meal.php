<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\{HasDocuments, HasServiceCenter};

/**
 * App\Models\Meal
 *
 * @property int $id
 * @property int $meal_type_id
 * @property int $quantity
 * @property string $to_model_type
 * @property int $to_model_id
 * @property string $sent_at
 * @property-read \App\Models\MealType $mealType
 * @method static \Database\Factories\MealFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereMealTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereToModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereToModelType($value)
 * @property-read \App\Models\ServiceCenter|null $serviceCenter
 * @mixin \Eloquent
 */
class Meal extends Model
{
	use HasDocuments, HasFactory, HasServiceCenter;

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * Get the meal type the meal belongs to
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 **/
	public function mealType(): BelongsTo
	{
		return $this->belongsTo(MealType::class);
	}
}
