<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEvaluationRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		return auth()->check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules(): array
	{
		return [
			'provider_model_type' => 'bail|required|string',
			'provider_model_id' => 'bail|required|integer',
            'vote' => 'bail|required'
		];
	}
}
