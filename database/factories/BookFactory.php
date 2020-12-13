<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3, true),
            'isbn' => $this->faker->isbn13(),
            'pages' => $this->faker->randomNumber(3),
            'description' => $this->faker->text(600),
            'price' => $this->faker->randomFloat(2,1,500),
            'published_at' => $this->faker->dateTimeBetween('-30 years', 'now', null),
            'publisher_id' => $this->faker->numberBetween(1, 3),
            'category_id' => $this->faker->numberBetween(1, 8),
            'cover_id' => $this->faker->numberBetween(1, 3),
            'language_id' => $this->faker->numberBetween(1, 2),
            'created_by' => '2',
            'updated_by' => '2'
        ];
    }
}
