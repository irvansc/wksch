<?php

namespace Database\Seeders;


use App\Models\LogoSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LogoSekolah::create([
            'logo_utama'=> null,
            'logo_email'=> null,
            'logo_favicon'=> null,
        ]);
    }
}
