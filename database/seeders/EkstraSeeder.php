<?php

namespace Database\Seeders;

use App\Models\Ekstra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EkstraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ekstra::create([
            'title' => 'Ekstrakulikuler',
            'description'=> 'description',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
