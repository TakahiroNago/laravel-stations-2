<?php

namespace Database\Seeders;

use App\Practice;
use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Practice::factory(10)->create();

        $seeds = [
            ['id' => 1, 'name' => 'action'],
            ['id' => 2, 'name' => 'comedy'],
            ['id' => 3, 'name' => 'documentary'],
        ];
        foreach ($seeds as $seed) {
            DB::table('genres')->insert($seed);
        }

        // Movie::factory(8)->create();

        Schedule::factory(30)->create();

        $seeds = [
            ['id' => 1, 'column' => 1, 'row' => 'a'],
            ['id' => 2, 'column' => 2, 'row' => 'a'],
            ['id' => 3, 'column' => 3, 'row' => 'a'],
            ['id' => 4, 'column' => 4, 'row' => 'a'],
            ['id' => 5, 'column' => 5, 'row' => 'a'],
            ['id' => 6, 'column' => 1, 'row' => 'b'],
            ['id' => 7, 'column' => 2, 'row' => 'b'],
            ['id' => 8, 'column' => 3, 'row' => 'b'],
            ['id' => 9, 'column' => 4, 'row' => 'b'],
            ['id' => 10, 'column' => 5, 'row' => 'b'],
            ['id' => 11, 'column' => 1, 'row' => 'c'],
            ['id' => 12, 'column' => 2, 'row' => 'c'],
            ['id' => 13, 'column' => 3, 'row' => 'c'],
            ['id' => 14, 'column' => 4, 'row' => 'c'],
            ['id' => 15, 'column' => 5, 'row' => 'c'],
        ];
        foreach ($seeds as $seed) {
            DB::table('sheets')->insert($seed);
        }
    }
}
