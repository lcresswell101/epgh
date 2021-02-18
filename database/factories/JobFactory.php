<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'type_id' => $this->faker->numberBetween(1, 5),
            'status_id' => $this->faker->numberBetween(1, 2),
            'date' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'time' => $this->faker->dateTime()->format('H:i'),
            'information' => $this->faker->realText(100),
            'engineer' => $this->faker->firstName,
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'postcode' => $this->faker->postcode,
            'invoice_number' => $this->faker->numberBetween(1000, 100000),
            'first_hour_cost' => $this->faker->numberBetween(1, 100),
            'material_cost' => $this->faker->numberBetween(1, 100),
            'labour_cost' => $this->faker->numberBetween(1, 100),
            'paypal_fee' => $this->faker->numberBetween(1, 100),
            'booking_fee' => $this->faker->numberBetween(1, 100),
            'vat' => $this->faker->numberBetween(1, 100),
            'total' => $this->faker->numberBetween(1, 100)
        ];
    }

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Job::factory()
            ->count(50)
            ->create();
    }
}
