<?php

namespace Database\Factories;

use App\Book;
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
        $categories = collect(['Novel', 'Illustrated Novel', 'Comic Book', 'Anthology', 'Picture Book']);

        $genres = collect(['Teen and Young Adult', 'New Adult', 'Romance', 'Detective and Mystery', 'Action', 'Historical', 'Thriller and Horror', 'LGBTQIA+', 'Poetry']);

        $image = $this->faker->image($dir = storage_path('app/public/book_cover/'), $width = 300, $height = 480);

        $arr = explode('\\', $image);
        $end = end($arr);
        $image = '/storage/book_cover/' . $end;
        return [
            'user_id' => 1,
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'slug' => $this->faker->slug,
            'class' => 'regular',
            'category' => $categories->random(),
            'author' => 'william',
            'genre' => $genres->random(),
            'language' => 'English',
            'lead_character' => 'Male',
            'lead_college' => 'Berkeley',
            'blurb' => $this->faker->text($maxNbChars = 200),
            'cost' => '19',
            'review_question_1' => 'review question 1?',
            'review_question_2' => 'review question 2?',
            'credit_page' => $this->faker->text($maxNbChars = 100),
            'cover' => $image,
            'cpy' => now(),
        ];
    }
}
