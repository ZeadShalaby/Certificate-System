<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password', // password
        ];
    }

    /**
     * Configure the factory with relationships.
     *
     * @return $this
     */
    public function configure()
    {

        return $this->afterCreating(function (User $user) {
            $img = ["images/users/user1.png", "images/users/user2.png", "images/users/user3.png", "images/users/user5.png"];
            $increment = random_int(0, 3);
            $user->media()->create([
                'media' => $img[$increment],
            ]);
        });
    }




    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
