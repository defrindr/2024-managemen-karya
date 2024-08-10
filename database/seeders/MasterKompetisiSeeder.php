<?php

namespace Database\Seeders;

use App\Models\JenisKompetisi;
use App\Models\TingkatKompetisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterKompetisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisKompetisi::create(['name' => 'Design Grafis']);
        JenisKompetisi::create(['name' => 'Programming']);
        JenisKompetisi::create(['name' => 'IoT']);

        TingkatKompetisi::create(['name' => 'Antar Kampus']);
        TingkatKompetisi::create(['name' => 'Provinsi']);
        TingkatKompetisi::create(['name' => 'Nasional']);
        TingkatKompetisi::create(['name' => 'Internasional']);
    }
}
