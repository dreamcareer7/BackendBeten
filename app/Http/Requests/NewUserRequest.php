<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class NewUserRequest extends FormRequest
{
	public function rules()
	{

		return [
			'name' => 'required|string|min:10', //|unique:users,name'.($resource_id > 0 ? ','.$resource_id : ''),
			'email'=>['required','email', Rule::unique('users')->ignore($this->id, 'id')],
			'username'=>['required', Rule::unique('users')->ignore($this->id, 'id')],
			'password' => 'min:8|confirmed',
			"contact"=>"required|min:5"

		];

	}

	public function authorize()
	{
		return true;
	}


}
