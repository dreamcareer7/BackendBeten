<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceCommitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'service_id' => 'bail|required|integer|exists:services,id',
            'badge' => 'bail|required|string|min:3|max:255',
            'scheduled_at' => 'bail|nullable|date_format:Y-m-d H:i:s',
            'started_at' => 'bail|nullable|date_format:Y-m-d H:i:s',
            'location' => 'bail|required|string|min:3|max:255',
            'supervisor_id' => 'bail|nullable|integer|exists:crews,id',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * Format the dates if present
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $fmt = 'Y-m-d H:i:s';
        $this->merge([
            'scheduled_at' => $this->scheduled_at ? date($fmt, strtotime($this->scheduled_at)) : null,
            'started_at' => $this->started_at ? date($fmt, strtotime($this->started_at)) : null,
        ]);
    }
}
