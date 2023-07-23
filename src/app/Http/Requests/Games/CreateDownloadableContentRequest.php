<?php

namespace App\Http\Requests\Games;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CreateDownloadableContentRequest extends FormRequest
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
            'platforms' => [
                'required',
                'array',
                'min:1',
            ],
            'platforms.*' => [
                'numeric',
                Rule::exists('platforms', 'id'),
            ],
            'storefronts' => [
                'required',
                'array',
                'min:1',
            ],
            'storefronts.*' => [
                'numeric',
                Rule::exists('storefronts', 'id'),
            ],
            'developers' => [
                'required',
                'array',
                'min:1',
            ],
            'developers.*' => [
                'numeric',
                Rule::exists('companies', 'id'),
            ],
            'publishers' => [
                'required',
                'array',
                'min:1',
            ],
            'publishers.*' => [
                'numeric',
                Rule::exists('companies', 'id'),
            ],
            'description'    => [
                'nullable',
                'string',
            ],
            'status_id' => [
                'required',
                Rule::exists('game_statuses', 'id'),
            ],
            'priority_id' => [
                'nullable',
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
