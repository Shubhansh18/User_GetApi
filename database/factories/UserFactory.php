<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static $freeEmailDomain = array('gmail.com', 'yahoo.com', 'hotmail.com');

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->freeEmail(),
            'mobile' => fake()->unique()->regexify('[6789][0-9]{9}'),
            'address' => fake()->address()
        ];
    }
}