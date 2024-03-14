<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'web_name'=>'SMKN WKNG',
            'web_tagline'=>'SMKN WKNG THE BEST',
            'web_email' => 'admin@wkngproject.com',
            'web_telp' => '085725071996',
            'web_maps' => 'https://maps.app.goo.gl/SnXsikK7A8VCGxHU6',
            'web_desc'=> 'smkn wkng mencetak generasi milenial',
            'web_alamat' => 'Kp Cicewol RT 03 RW 01 Des. Mekarsari Kec.Cicurug Kab. Sukabumi 43359',
        ]);
    }
}
