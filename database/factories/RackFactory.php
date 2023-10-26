<?php

namespace Database\Factories;

use App\Models\Rack;
use App\Models\RackSpace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rack>
 */
class RackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Rack-' . $this->faker->randomNumber,
            'description' => $this->faker->text(100),
        ];
    }

    // when you create the rack it should also create  multiple rackSpace (randomly generated from 1 to 128) for that rack (one to many relationship)
    // the unit_number should be unique for each rackSpace and it should be in ascending order (from 1 to the number of rackSpace)

    public function configure()
    {
        return $this->afterCreating(function (Rack $rack) {
            $rack->rackSpaces()->saveMany(
                RackSpace::factory()
                    ->count(rand(1, 128))
                    ->make()
            );
        });
    }
}
