<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['id' => 1, 'icon' => '1.png', 'name' => 'Kompetisi']);
        Category::create(['id' => 2, 'icon' => '1.png', 'name' => 'Project']);
        Category::create(['id' => 3, 'icon' => '1.png', 'name' => 'Tugas Perkuliahan']);
    }
}
