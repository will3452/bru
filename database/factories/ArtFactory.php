<?php

namespace Database\Factories;

use App\Art;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Art::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = collect(['Novel', 'Illustrated Novel', 'Comic Book', 'Anthology', 'Picture Book']);

        $genres = collect(['Teen and Young Adult', 'New Adult', 'Romance', 'Detective and Mystery', 'Action', 'Historical', 'Thriller and Horror', 'LGBTQIA+', 'Poetry']);

        $image = $this->faker->image($dir = storage_path('app/public/arts/'), $width = 300, $height = 480);

        $arr = explode('/', $image);
        $end = end($arr);
        $image = '/storage/arts/' . $end;

        return [
            'user_id' => 1,
            'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
            'description' => $this->faker->text($maxNbChars = 200),
            'artist' => 'william',
            'genre' => $genres->random(),
            'lead_college' => 'Berkeley',
            'cost' => 25,
            'file' => $image,
        ];
    }
}
