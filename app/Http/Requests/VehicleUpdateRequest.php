<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VehicleUpdateRequest extends FormRequest
{
	public function rules()
	{

		return [
			'id' => ['required',Rule::exists('vehicles')],
			'model' => 'required',
			'registration'=>['required', Rule::unique('vehicles')->ignore($this->id, 'id')],
			'manufacturer'=>['required'],
			'year' => 'required',
			'badge' => 'required',
		];

	}


	public function authorize()
	{
		return true;
	}


}
