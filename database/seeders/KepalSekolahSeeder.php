<?php

namespace Database\Seeders;

use App\Models\KepalaSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepalSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KepalaSekolah::create([
            'name'=>'Irvan Maulana, S.Pd',
            'nip'=>'123',
            'akreditasi' => 'A+',
            'serint' => 'SERTIFIKAT NASIONAL',
            'desc' => 'SELAMAT DATANG DI WEBSITE WKNG SCHOOL',
            'video_url' => 'URL',
        ]);
    }
}
