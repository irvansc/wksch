<?php

namespace Database\Seeders;

use App\Models\Idse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Idse::create([
            'nama_sekolah' => 'WKNG SCHOOL',
            'nss' => '12346789',
            'akreditasi' => 'A+',
            'status' => 'Goverment/state',
            'nokep' => '123456789',
            'luas_area'=> '2500he',
            'alamat' => 'JL Raya Siliwangi KM 20',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
