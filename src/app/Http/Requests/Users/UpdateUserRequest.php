<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User $user */
        $user = $this->user();
        return $user->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'   => [
                'nullable',
                Rule::unique('users', 'email')
                    ->ignoreModel($this->user),
                'email',
            ],
            'name'    => [
                'nullable',
                'string',
            ],
            'role_id' => [
                'nullable',
                Rule::exists('user_roles', 'id'),
            ],
        ];
    }
}
