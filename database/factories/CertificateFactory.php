<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * اسم النموذج المرتبط بهذه الفابريكيشن.
     *
     * @var string
     */
    protected $model = \App\Models\Certificate::class;

    /**
     * تعريف الحالة الافتراضية للنموذج.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'courses' => $this->faker->randomElement(['Mathematics', 'Physics', 'Chemistry', 'Biology', 'Computer Science']),
            'groups' => $this->faker->randomElement(['Group A', 'Group B', 'Group C']),
            'name' => $this->faker->name(),
            'gmail' => $this->faker->unique()->safeEmail(),
            'acdemic_number' => $this->faker->unique()->numberBetween(100000, 999999),
            'title' => $this->faker->sentence(3),
            'start_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'end_at' => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['start_at'], '+6 months');
            },
        ];
    }
}
