<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'id' => 1,
            'name' => 'Tim 1',
            'created_by' => User::where('role_id', 3)->inRandomOrder()->first()->id,
        ]);
        Team::create([
            'id' => 2,
            'name' => 'Tim 2',
            'created_by' => User::where('role_id', 3)->inRandomOrder()->first()->id,
        ]);
    }
}
