<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		return auth()->check() && $this->user()->can('clients.create');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules(): array
	{
		// TODO: Check if this client already exists
		// $client = Client::where('country_id', $request->input('country_id'))
		// 	->where('id_type', $request->input('id_type'))
		// 	->where('id_number', $request->input('id_number'))->first();
		return [
			'fullname' => 'bail|required|string|min:3|max:50',
			'country_id' => 'bail|required|integer|exists:countries,id',
			'id_type' => 'bail|required|string|min:3|max:255',
			'id_number' => 'bail|required|string|min:3|max:255',
			'id_name' => 'bail|required|string|min:3|max:255',
			'gender' => 'bail|required|string|in:Male,Female',
			'is_handicap' => 'bail|required|boolean',
		];
	}
}
