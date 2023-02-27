<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasContracts
{
	/**
	 * The "boot" method of the model.
	 *
	 * Intercept the update, check if there are contracts files on the request
	 * and if so, create new contracts and attach them to the model
	 *
	 * @return void
	 */
	protected static function bootHasContracts(): void
	{
		static::saving(function ($model) {
			if (request()->hasFile('contracts')) {
				foreach (request()->contracts as $contract) {
					$model->contracts()->create([
						'title' => $contract->getClientOriginalName(),
						'url' => $contract->store('contracts'),
					]);
				}
			}
		});
	}
	

	/**
	 * Get the contracts belonging to the model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function contracts(): MorphMany
	{
		return $this->morphOne(Contract::class, 'contractable');
	}
}
