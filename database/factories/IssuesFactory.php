<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IssuesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(2),
            'description' => $this->faker->sentence(10,true),
            'parentIssueID' => $this->faker->randomDigit(),
            'assignedToUserID' => $this->faker->randomDigit(),
            'clientID' => '9',
        ];
    }
}
