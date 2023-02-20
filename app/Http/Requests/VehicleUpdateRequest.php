<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class VehicleUpdateRequest extends FormRequest
{
    public function rules()
    {

        return [
            'model' => 'required',
            'registration'=>['required','email', Rule::unique('vehicles')->ignore($this->id, 'id')],
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
