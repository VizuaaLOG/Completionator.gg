<?php

namespace Database\Factories;

use App\Models\Storefront;
use Illuminate\Database\Eloquent\Factories\Factory;

class StorefrontFactory extends Factory
{
    protected $model = Storefront::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
        ];
    }
}
