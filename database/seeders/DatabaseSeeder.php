<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            TypeSeeder::class,
            UserSeeder::class,
            SocialSeeder::class,
            SettingSeeder::class,
            LogoSeeder::class,
            EventSeeder::class,
            KepalSekolahSeeder::class,
            IdseSeeder::class,
            SejarahSeeder::class,
            VmSeeder::class,
            PetaSeeder::class,
            SaranaSeeder::class,
            EkstraSeeder::class,
            PrestasiSeeder::class,

        ]);
    }
}
