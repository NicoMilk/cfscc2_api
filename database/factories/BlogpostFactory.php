<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Blogpost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogpostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blogpost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "author_id" => User::all()->random()->id,
            "title" => $this->faker->sentence(),
            "content" => $this->faker->paragraph(3, true),
        ];
    }
}
