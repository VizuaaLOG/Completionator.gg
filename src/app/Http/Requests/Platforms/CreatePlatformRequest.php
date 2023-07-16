<?php

namespace App\Http\Requests\Platforms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CreatePlatformRequest extends FormRequest
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
            'description'    => [
                'nullable',
                'string',
            ],
            'purchase_date' => [
                'nullable',
                'date_format:Y-m-d',
            ],
            'release_date' => [
                'nullable',
                'date_format:Y-m-d',
            ],
            'cover' => [
                'nullable',
                'image',
            ],
            'hero' => [
                'nullable',
                'image',
            ],
        ];
    }
}
