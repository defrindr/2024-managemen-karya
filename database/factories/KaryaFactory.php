<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karya>
 */
class KaryaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'team_id' => Team::inRandomOrder()->first()->id,
            'judul' => fake()->title,
            'gambar' => 'demo.jpeg',
            'deskripsi' => fake()->realText(),
            'link_youtube' => 'https://www.youtube.com/watch?v=QZTkb69D64E',
            'created_by' => User::inRandomOrder()->first()->id,
            'approved_by' => User::inRandomOrder()->first()->id,
        ];
    }
}