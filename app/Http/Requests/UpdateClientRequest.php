<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
	public function rules()
	{
		return [
			'fullname' => 'required',
			'gender'=>['required'],
			'country_id'=>['required'],
			 'phone' => 'required',
			 'id_type' => 'required',
			 'id_no' => 'required',
			 'dob' => 'required',
		 ];
	}

	public function authorize()
	{
		return true;
	}


}
