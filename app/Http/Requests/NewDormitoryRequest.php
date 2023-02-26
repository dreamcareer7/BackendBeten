<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewDormitoryRequest extends FormRequest
{
	public function rules()
	{
		return [
			'title' => 'required',
			'phones'=>['required'],
			'city_id'=>['required'],
			 'location' => 'required',
			 'coordinate' => 'required',
			 'is_active' => ['nullable', 'boolean'],
		];
	}

	public function authorize()
	{
		return true;
	}


}
