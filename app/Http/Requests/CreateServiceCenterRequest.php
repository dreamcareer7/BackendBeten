<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceCenterRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		// TODO: also check permission
		return auth()->check() && $this->user()->can('service_centers.create');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules(): array
	{
		return [
			'title'=> 'bail|required|string|min:3|max:50',
			'phone'=>['bail', 'nullable', 'integer'], 
			'location'=>['bail', 'nullable', 'string'],
			'group'=>['bail', 'nullable', 'string'],
			'maxClientCount'=>['bail', 'nullable', 'integer'],
			
			'name' => 'bail|required|string|min:3|max:255',
			'email' => 'bail|required|string|unique:users,email',
			'contact' => 'bail|required|min:5|max:255',
		];
	}
}
