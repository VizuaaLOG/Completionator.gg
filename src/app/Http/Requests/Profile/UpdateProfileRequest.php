<?php

namespace App\Http\Requests\Profile;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'    => [
                'nullable',
                Rule::unique('users', 'email')
                    ->ignoreModel($this->user()),
                'email',
            ],
            'name'     => [
                'nullable',
                'string',
            ],
            'password' => [
                'nullable',
                'string',
                'confirmed',
            ],
        ];
    }
}
