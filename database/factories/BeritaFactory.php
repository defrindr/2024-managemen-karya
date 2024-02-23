<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->text();
        return [
            'judul' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'konten' => fake()->realText(),
            'gambar' => 'fake.jpeg',
            'created_by' => User::inRandomOrder()->first()->id,
        ];
    }
}
