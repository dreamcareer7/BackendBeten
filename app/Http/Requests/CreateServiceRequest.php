<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\ServiceDatesRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
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
			'title' => 'bail|required|string|min:3|max:255',
			'city_id' => 'bail|required|integer|exists:cities,id',
			// We must receive only one of these 3 dates
            'before_date' => ['bail', new ServiceDatesRule(fieldname: 'before_date')],
            'exact_date' => ['bail', new ServiceDatesRule(fieldname: 'exact_date')],
            'after_date' => ['bail', new ServiceDatesRule(fieldname: 'after_date')],
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array<string, string>
	 */
	public function messages(): array
	{
		return [
			'before_date.prohibits' => __('Only one date is allowed'),
			'exact_date.prohibits' => __('Only one date is allowed'),
			'after_date.prohibits' => __('Only one date is allowed'),
		];
	}
}
