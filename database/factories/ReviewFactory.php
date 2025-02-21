<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => null, //this column will be filled by the id that is created in the feeder file
            'review' => fake()->paragraph, //generate paragraph
            'rating' => fake()->numberBetween(1, 5), //generate number between 1 to 5
            'created_at' => fake()->dateTimeBetween('-2 years'), // generate created data
            // 'updated_at' => fake()->dateTimeBetween('created_at', 'now') // generate updated data(old code)
            'updated_at' => function (array $attributes) { // generate updated data(new code)
                return fake()->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    //generate some custom method to get some diversity with resource

    //generate state method good review dummy data
    public function good()
    {
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(4, 5) // rate between 4 to 5 is good
            ];
        });
    }

    //generate state method average review dummy data
    public function average()
    {
        return $this->state(function (array $attributes){
            return [
                'rating' => fake()->numberBetween(2, 5) //rate between 2 to 5 is average
            ];
        });
    }

    //generate state method bad review dummy data
    public function bad()
    {
        return $this->state(function (array $attributes){
            return [
                'rating' => fake()->numberBetween(1, 3) //rate between 1 to 3 is considered bad
            ];
        });
    }
}
