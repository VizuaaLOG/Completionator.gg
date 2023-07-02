<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Services\SettingService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class RunMigrationsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Once initial setup is complete, only an admin can trigger this
        $settingService = resolve(SettingService::class);
        if ($settingService->initialSetupCompleted()) {
            /** @var User $user */
            $user = $this->user();
            return $user->isAdmin();
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [];
    }
}
