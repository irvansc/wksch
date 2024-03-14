<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialMedia::create([
            'bsm_facebook'=>'https://www.facebook.com/',
            'bsm_instagram'=>'https://www.facebook.com/',
            'bsm_youtube'=>'https://www.facebook.com/',
            'bsm_twitter'=>'https://www.facebook.com/',
            'bsm_web'=>'https://www.facebook.com/',

        ]);
    }
}
