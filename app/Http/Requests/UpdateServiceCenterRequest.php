<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceCenterRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		// TODO: also check permission
        return auth()->check() && $this->user()->can('service_centers.update');
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
            'phone'=>['bail', 'required', 'nullable', 'integer'],
            'location'=>['bail', 'required', 'nullable', 'string'],
            'group'=>['bail', 'required', 'nullable', 'string'],
            'maxClientCount'=>['bail', 'required', 'nullable', 'integer']
        ];
	}
}
