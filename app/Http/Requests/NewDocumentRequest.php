<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           "title"=>"request",
            "model_type"=>"request",
            "model_id"=>"request",
            "document_type"=>"request",
            "description"=>"request",
            "image"=>"required"
        ];
    }
}
