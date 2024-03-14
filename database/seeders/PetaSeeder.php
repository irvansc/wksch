<?php

namespace Database\Seeders;
use App\Models\PetaSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PetaSekolah::create([
            'title' => 'Peta Sekolah',
            'desc' => 'Peta sekolah',
            'image' => 'example.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]); 
    }
}
