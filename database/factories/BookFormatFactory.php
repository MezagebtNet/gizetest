<?php

namespace Database\Factories;

use App\Models\BookFormat;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFormatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookFormat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
