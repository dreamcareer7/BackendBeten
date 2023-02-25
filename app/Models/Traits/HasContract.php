<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasContract
{
	/**
	 * The "boot" method of the model.
	 *
	 * Intercept the update, check if there's a contract file on the request
	 * and if so, create a new contract and attach it to the model
	 *
	 * @return void
	 */
	protected static function bootHasContract(): void
	{
		static::saving(function ($model) {
			if (request()->hasFile('contract')) {
				$model->contract()->create([
					'url' => request()->contract->store('contracts')
				]);
			}
		});
	}

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
