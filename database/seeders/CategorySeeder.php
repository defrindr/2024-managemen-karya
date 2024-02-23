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
        Category::create(['icon' => '1.png', 'name' => 'Teknologi Informasi']);
        Category::create(['icon' => '1.png', 'name' => 'Pangan']);
        Category::create(['icon' => '1.png', 'name' => 'Otomotif']);
    }
}
