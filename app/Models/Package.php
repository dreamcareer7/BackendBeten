<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\API\API\API\API\API\API\API\API\SubscriptionController;

/**
 * App\Models\Package
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @mixin \Eloquent
 */
class Package extends Model
{
	use HasFactory;

	public function subscriptions(){
		return $this->hasMany(SubscriptionController::class);
	}
}
