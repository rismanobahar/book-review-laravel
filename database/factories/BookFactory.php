<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // generate the following dummy data model
        return [
            'title' => fake()->sentence(3), // generate sentence with at least 3 words or more
            'author' => fake()->name, // generate a name  
            'created_at' => fake()->dateTimeBetween('-2 years'), //generate a created date
            // 'updated_at' => fake()->dateTimeBetween('created_at', 'now') // generate an updated date(old code)
            'updated_at' => function (array $attributes) { // generate updated data(new code)
                return fake()->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }
}
