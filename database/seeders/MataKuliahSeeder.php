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
        MataKuliah::create(['kode' => '12001','name' => 'Pemrograman Perangkat Bergerak']);
        MataKuliah::create(['kode' => '12002','name' => 'Pemrograman Berbasis Objek']);
        MataKuliah::create(['kode' => '12003','name' => 'Basis Data']);
        MataKuliah::create(['kode' => '12004','name' => 'Cloud Management']);
    }
}
