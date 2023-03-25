<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Concurrent;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreateConcurrentRequest extends FormRequest
{
	/** @var string $table Database table to check type ID existence in */
	private string $table = '';

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		// TODO: validate permission as well
		return auth()->check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules(): array
	{
		$valid_types = implode(',', Concurrent::$model_types);
		return [
			'model_type' => 'bail|required|string|in:' . $valid_types,
			'model_id' => "bail|required|integer|exists:{$this->table},id",
			'starting_at' => 'bail|required|date_format:Y-m-d',
			'ending_at' => 'bail|required|date_format:Y-m-d',
			'extra' => 'bail|required',
		];
	}

	/**
	 * Prepare the data for validation.
	 *
	 * @return void
	 */
	protected function prepareForValidation(): void
	{
		if ($this->type) {
			$model = 'App\Models\\' . Str::title($this->type);
			$this->merge([
				'model_type' => $model,
			]);
			$this->table = (new $model)->getTable();
		}
		if ($this->id) {
			$this->merge([
				'model_id' => (int) $this->id,
			]);
		}
	}
}
