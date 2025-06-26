<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use App\Models\Rating;
use App\Models\Cart;
use App\Models\Copy;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->count(20)->create();

        $users->each(function ($user) {

            Cart::factory()->create(['user_id' => $user->id]);

            if ($user->merchant) {
                $listings = Listing::factory()->count(rand(0, 10))->for($user)->create();

                $listings->each(function ($listing) {
                    Copy::factory()->count(rand(0, 10))->create([
                        'listing_id' => $listing->id
                    ]);
                    Rating::factory()->count(rand(1, 5))->create([
                        'listing_id' => $listing->id,
                        'user_id' => User::inRandomOrder()->first()->id
                    ]);
                });
            }
        });
    }
}
