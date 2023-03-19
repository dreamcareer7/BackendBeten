<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class CreateUserRequest extends FormRequest
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
			'name' => 'bail|required|string|min:3|max:255',
			// 'email' => 'bail|required|email|unique:users,id',
			'email' => [
                'required',
                'email',
                Rule::unique('users')->where(function ($query) {
                    $query->where('email', $this->input('email'));
                }),
            ],
			// Password validation rules
			'password' => [
				'bail',
				'required',
				'confirmed',
				Password::min(8)
					->letters()
					->numbers()
			],
			'is_active' => 'bail|nullable|boolean',
			'contact' => 'bail|required|min:5|max:255',
		];
	}
	
	
	public function messages()
    {
        return [
            'email.unique' => 'This email is already registered.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            try {
                $this->runUniqueEmailValidation();
            } catch (QueryException $e) {
                $validator->errors()->add('email', 'This email is already registered.');
                throw new HttpResponseException(response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => $validator->errors(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY));
            }
        });
    }

    protected function runUniqueEmailValidation()
    {
        $validator = $this->getValidatorInstance();
        // $validator->validateUnique($this->email, 'users', 'email_address', $this->user, 'id');
    }
}
