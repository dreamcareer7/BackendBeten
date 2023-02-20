<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class NewGroupRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'crew_id'=>['required',Rule::exists('crews','id')],
        ];
    }

    public function authorize()
    {
        return true;
    }


}
