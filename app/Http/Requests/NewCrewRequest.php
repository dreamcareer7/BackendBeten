<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class NewCrewRequest extends FormRequest
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
