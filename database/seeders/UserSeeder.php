<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'name' => 'administrator',
            'password' => 'password',
            'role_id' => 1,
            'status' => 1
        ]);

        //\App\Models\User::factory(50)->create();
    }
}
