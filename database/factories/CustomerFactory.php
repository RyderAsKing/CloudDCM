<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //         $table->string('company_name');
        // $table->string('phone');
        // $table->string('email');
        // $table->string('contact_name');
        // $table->string('address');
        // $table->string('city');
        // $table->string('sales_person');
        // $table->integer('num_desktops');
        // $table->integer('num_notebooks');
        // $table->integer('num_printers');
        // $table->integer('num_servers');
        // $table->integer('num_firewalls');
        // $table->integer('num_wifi_access_points');
        // $table->integer('num_switches');
        // $table->integer('quote_provided');
        return [
            //
            'company_name' => $this->faker->company,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'contact_name' => $this->faker->name,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'sales_person' => $this->faker->name,
            'num_desktops' => $this->faker->numberBetween(0, 10),
            'num_notebooks' => $this->faker->numberBetween(0, 10),
            'num_printers' => $this->faker->numberBetween(0, 10),
            'num_servers' => $this->faker->numberBetween(0, 10),
            'num_firewalls' => $this->faker->numberBetween(0, 10),
            'num_wifi_access_points' => $this->faker->numberBetween(0, 10),
            'num_switches' => $this->faker->numberBetween(0, 10),
            'quote_provided' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
