<?php

namespace App\Services;

use Schema;
use App\Models\Setting;

class SettingService
{
    public static function instance(): self
    {
        return resolve(self::class);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $value = Setting::where('key', $key)->first();

        return match ($value->type) {
            'boolean' => filter_var($value->value, FILTER_VALIDATE_BOOL),
            'number' => filter_var($value->value, FILTER_VALIDATE_INT),
            default => $value->value,
        };
    }

    public function set(string $key, mixed $value = null): Setting
    {
        return Setting::updateOrCreate(['key' => $key], ['key' => $key, 'value' => $value]);
    }

    public function initialSetupCompleted(): bool
    {
        return Schema::hasTable('settings')
            && $this->get('system.setup.complete');
    }
}
