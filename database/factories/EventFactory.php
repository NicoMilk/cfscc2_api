<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "type" => $this->faker->randomElement([
                "PSC1",
                "PSC2",
                "PSE1",
                "PSE2",
            ]),
            "description" => $this->faker->sentence(),
            "date_start" => $this->faker->date("Y-m-d", "now"),
            "date_end" => $this->faker->date("Y-m-d", "now"),
            "price" => $this->faker->numberBetween(10, 50),
            "slots" => $this->faker->numberBetween(10, 20),
            "slots_left" => $this->faker->numberBetween(1, 5),
        ];
    }
}
