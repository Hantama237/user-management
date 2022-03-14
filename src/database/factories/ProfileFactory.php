<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "picture"=>$this->faker->file(public_path("/assets/images/example/profile"),public_path("/assets/images/profile"),false),
            "name" => $this->faker->name(),
            "nationality" => $this->faker->randomElement(['China', 'America','Russia','Ukraine']),
            "gender" => $this->faker->randomElement(['male', 'female']),
            "date_of_birth"=>$this->faker->date('Y-m-d', 'now'),
            "profileable_id"=>null,
            "profileable_type"=>null

        ];
    }
}
