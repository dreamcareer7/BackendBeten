<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check() && $this->user()->can('cities.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'bail|required|min:3',
            'location_url' => 'bail|required|url'
            ];
    }

    public function attributes()
    {
        return [
            'title' => 'Title',
            'location_url' => 'Location url'
        ];
    }
}
