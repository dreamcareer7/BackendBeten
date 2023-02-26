<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasDocuments;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
	use HasDocuments;

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
}
