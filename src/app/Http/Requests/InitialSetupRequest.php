<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Services\SettingService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class InitialSetupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !SettingService::instance()->initialSetupCompleted()
            || User::count() === 0;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'admin.email'          => [
                'required',
            ],
            'admin.password'       => [
                'required',
            ],
            'admin.name'           => [
                'required',
            ],
        ];
    }
}
