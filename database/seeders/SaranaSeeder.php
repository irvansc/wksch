<?php

namespace Database\Seeders;

use App\Models\SaranaSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaranaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SaranaSekolah::create([
            'title' => 'Sarana sekolah',
            'description'=> 'Sarana sekolah',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
