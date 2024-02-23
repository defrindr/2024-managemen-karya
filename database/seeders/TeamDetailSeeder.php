<?php

namespace Database\Seeders;

use App\Models\TeamDetail;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeamDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamDetail::create([
            'user_id' => User::where('role_id', 3)->inRandomOrder()->first()->id,
            'team_id' => 1,
            'approve' => true,
        ]);
        TeamDetail::create([
            'user_id' => User::where('role_id', 3)->inRandomOrder()->first()->id,
            'team_id' => 1,
            'approve' => true,
        ]);
        TeamDetail::create([
            'user_id' => User::where('role_id', 3)->inRandomOrder()->first()->id,
            'team_id' => 1,
            'approve' => true,
        ]);
        TeamDetail::create([
            'user_id' => User::where('role_id', 3)->inRandomOrder()->first()->id,
            'team_id' => 2,
            'approve' => true,
        ]);
        TeamDetail::create([
            'user_id' => User::where('role_id', 3)->inRandomOrder()->first()->id,
            'team_id' => 2,
            'approve' => true,
        ]);
        TeamDetail::create([
            'user_id' => User::where('role_id', 3)->inRandomOrder()->first()->id,
            'team_id' => 2,
            'approve' => true,
        ]);
    }
}
