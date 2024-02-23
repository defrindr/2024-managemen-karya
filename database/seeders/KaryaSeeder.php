<?php

namespace Database\Seeders;

use App\Models\Karya;
use Illuminate\Database\Seeder;

class KaryaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Karya::factory(100)->create();
    }
}
