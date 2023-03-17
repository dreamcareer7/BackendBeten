<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCrewRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		return auth()->check() && $this->user()->can('crews.create');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules(): array
	{
		// TODO:
		//check if any crew with same id type id number and country already exists
		/*$exists = Crew::where('id_type',$request->input('id_type'))
			->where('id_number',$request->input('id_number'))
			->where('country_id', $data['country_id'])
			->exists();*/
		return [
			'user_id' => 'bail|nullable|integer|exists:users,id',
			'fullname' => 'bail|required|string|min:3|max:255',
			'gender' => 'bail|required|string|in:Male,Female',
			'profession_id' => 'bail|required|integer|exists:professions,id',
			'country_id' => 'bail|required|integer|exists:countries,id',
			'phone' => 'bail|required|string|min:3|max:255',
			'id_type' => 'bail|required|string|min:3|max:255',
			'id_name' => 'bail|required|string|min:3|max:255',
			'id_number' => 'bail|required|string|min:3|max:255',
			'dob' => 'bail|required|date_format:Y-m-d',
			'is_active' => 'bail|required|boolean',
		 ];
	}
}
