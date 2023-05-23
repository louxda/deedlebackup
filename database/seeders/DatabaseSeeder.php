<?php

namespace Database\Seeders;

use App\Models\DailyChallenge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $deedles = [ "Help Someone.", "Eat Banana", "Watch Morbius", "Rate Batman on Imdb" ];
        foreach ($deedles as $key => $deedle) {
            DailyChallenge::query()->create([
                "title"     => $deedle,
                "dated_for" => Carbon::today()->addDays($key),
            ]);
        }
    }
}
