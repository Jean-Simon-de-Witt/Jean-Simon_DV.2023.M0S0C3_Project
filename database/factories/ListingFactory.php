<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Listing;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{

    protected $model = Listing::class;
    
    public function definition(): array
    {
        return [
            'name' => fake()->word(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 5, 500),
            'category' => fake()->word(),
            'image' => "https://as2.ftcdn.net/jpg/06/10/96/51/1000_F_610965131_n3DB7jrPtQ4XfUQxecGqN30CiJnSoit0.jpg"
        ];
    }
}
