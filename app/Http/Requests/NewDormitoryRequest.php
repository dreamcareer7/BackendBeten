<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class NewDormitoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'phone'=>['required'],
            'country'=>['required'],
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
