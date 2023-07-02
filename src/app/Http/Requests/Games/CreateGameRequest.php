<?php

namespace App\Http\Requests\Games;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CreateGameRequest extends FormRequest
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
            'name'   => [
                'required',
                'string',
                'max:200',
            ],
            'platform_ids' => [
                'required',
                'array',
                'min:1',
            ],
            'platform_ids.*' => [
                'integer',
                Rule::exists('platforms', 'id'),
            ],
            'description'    => [
                'nullable',
                'string',
            ],
            'status_id' => [
                'sometimes',
                Rule::exists('game_statuses', 'id'),
            ],
            'priority_id' => [
                'sometimes',
                Rule::exists('game_priorities', 'id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'platform_ids.*' => "Invalid platform given",
        ];
    }
}
