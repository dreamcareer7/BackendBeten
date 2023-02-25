<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
			'id' => ['required_without:documents', Rule::exists('vehicles')],
			'model' => 'required_without:documents',
			'registration'=>['required_without:documents', Rule::unique('vehicles')->ignore($this->id, 'id')],
			'manufacturer'=>['required_without:documents'],
			'year' => 'required_without:documents',
			'badge' => 'required_without:documents',
		];
	}
}
