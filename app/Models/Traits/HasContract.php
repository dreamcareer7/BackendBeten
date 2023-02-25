<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasContract
{
	// TODO: intercept updating
	/**
	 * Get the contract belonging to the model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphOne
	 */
	public function contract(): MorphOne
	{
		return $this->morphOne(Contract::class, 'contractable');
	}
}
