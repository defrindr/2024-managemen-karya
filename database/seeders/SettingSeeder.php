<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'judul' => 'MAKARYA2',
            'banner' => 'default.jpeg',
            'deskripsi' => 'Wesbite keren',
            'informasi_kontak' => 'Politeknik Negeri Malang<br>Jl. Soekarno Hatta No. 9 <br>Kota Malang - Jawa Timur <br>Indonesia <br><br><strong>Phone:</strong> 0341 - 404424/404425<br><strong>Email:</strong> humas@polinema.ac.id<br>',
            'social_media' => json_encode([
                'twitter' => '#',
                'facebook' => '#',
                'instagram' => '#',
                'skype' => '#',
                'linkedin' => '#',
            ])
        ]);
    }
}
