<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules()
    {

        return [
            'name' => 'required|string|min:10', //|unique:users,name'.($resource_id > 0 ? ','.$resource_id : ''),
            'email'=>['required','email', Rule::unique('users')->ignore($this->id, 'id')],
            'username'=>['required', Rule::unique('users')->ignore($this->id, 'id')],
             'password' => 'min:8|confirmed',
            /*
                        'password' => [	// reference https://stackoverflow.com/questions/31539727/laravel-password-validation-rule
                                    'sometimes',
                                    'nullable',
                                    'string',
                                    'min:6',			  // must not be less than 6 letters
                                    'max:16',			  // must not be more than 16 letters
                                    //'regex:/[a-z]/',      // must contain at least one lowercase letter
                                    //'regex:/[A-Z]/',      // must contain at least one uppercase letter
                                    //'regex:/[0-9]/',      // must contain at least one digit
                                    //'regex:/[@$!%*#?&]/', // must contain a special character
                                    ],
                        'password_confirmation' => 'sometimes|nullable|min:6|max:16|same:password',
            */
        ];

    }

    public function authorize()
    {
        return true;
    }


}
