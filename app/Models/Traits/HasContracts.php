<?php

declare(strict_types=1);

namespace App\Models\Traits;

trait HasContracts
{
	/**
	 * The "boot" method of the model.
	 *
	 * @return void
	 */
	protected static function bootHasContracts(): void
	{
		// Any model that uses this trait should append a property called
		// is_contractable with a value of true
		static::retrieved(function ($model) {
			$model->is_contractable = true;
		});
	}
}
