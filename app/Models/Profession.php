<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Profession
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Profession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profession query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profession whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profession whereUpdatedAt($value)
 * @method static \Database\Factories\ProfessionFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
class Profession extends Model
{
	use HasFactory;

	protected $table = 'professions';

	protected $fillable = [
		'title',
	];
}
