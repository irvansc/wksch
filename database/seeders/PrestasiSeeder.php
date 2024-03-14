<?php

namespace Database\Seeders;

use App\Models\PrestasiSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrestasiSekolah::create([
            'title' => 'Prestasi',
            'description'=> 'description',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
