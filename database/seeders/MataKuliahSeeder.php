<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MataKuliah::create(['name' => 'Pemrograman Perangkat Bergerak']);
        MataKuliah::create(['name' => 'Pemrograman Berbasis Objek']);
        MataKuliah::create(['name' => 'Basis Data']);
        MataKuliah::create(['name' => 'Cloud Management']);
    }
}
