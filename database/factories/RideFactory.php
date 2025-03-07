<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ride;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ride>
 */
class RideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'start_location' => $this->faker->city,
            'end_location' => $this->faker->city,
            'departure_day' => $this->faker->date(),
            'departure_time' => $this->faker->time(),
            'available_seats' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(10, 100),
            'status' => $this->faker->randomElement(['open', 'full', 'cancelled']),
        
        ];
    }
}
