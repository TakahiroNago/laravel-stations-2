<?php

namespace Database\Factories;

use App\Models\Movie;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = rand(0, 100);

        return [
            'movie_id' => Movie::factory(),
            'start_time' => CarbonImmutable::now()->addHours($rand),
            'end_time' => CarbonImmutable::now()->addHours($rand + 2),
        ];
    }
}
