<?php

namespace App\Http\Requests\Games;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateGameRequest extends FormRequest
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
                'nullable',
                'string',
                'max:200',
            ],
            'platform_ids' => [
                'sometimes',
                'array',
                'min:1',
            ],
            'platform_ids.*' => [
                'integer',
                Rule::exists('platforms', 'id'),
            ],
            'status_id' => [
                'sometimes',
                Rule::exists('game_statuses', 'id'),
            ],
            'priority_id' => [
                'sometimes',
                Rule::exists('game_priorities', 'id'),
            ],
            'description'    => [
                'nullable',
                'string',
            ],
        ];
    }
}
