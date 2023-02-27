<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Document;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasDocuments
{
	/**
	 * The "boot" method of the model.
	 *
	 * Intercept the update, check if there are documents files on the request
	 * and if so, create new documents and attach them to the model
	 *
	 * @return void
	 */
	protected static function bootHasDocuments(): void
	{
		static::saving(function ($model) {
			unset($model->is_documentable);
			if (request()->hasFile('documents')) {
				foreach (request()->documents as $document) {
					$model->documents()->create([
						'title' => $document->getClientOriginalName(),
						'path' => $document->store('documents'),
					]);
				}
			}
		});

		// Any model that uses this trait should append a property called
		// is_documentable with a value of true
		static::retrieved(function ($model) {
			$model->is_documentable = true;
		});
	}

	/**
	 * Get the documents belonging to the model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function documents(): MorphMany
	{
		return $this->morphMany(related: Document::class, name: 'documentable');
	}
}
