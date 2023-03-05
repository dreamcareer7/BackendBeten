<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewVehicleRequest extends FormRequest
{
	public function rules()
	{
		return [
			'model' => 'required',
			'registration'=>['required'],
			'manufacturer'=>['required'],
			 'year' => 'required',
			 'badge' => 'required|integer|min:3|max:2147483647',
		];
	}

	public function authorize()
	{
		return true;
	}


}
