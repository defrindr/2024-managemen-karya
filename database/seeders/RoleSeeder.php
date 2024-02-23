<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['id' => 1, 'name' => 'Administrator']);
        Role::create(['id' => 2, 'name' => 'Dosen']);
        Role::create(['id' => 3, 'name' => 'Mahasiswa']);
    }
}
