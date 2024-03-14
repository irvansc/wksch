<?php

namespace Database\Seeders;
use App\Models\Vimi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vimi::create([
            'visi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit in et blandit mus nam, libero enim hac lectus sem tempus varius sed donec imperdiet consequat. Dapibus vitae phasellus vel cursus egestas nam ad eget condimentum,',
            'misi' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit in et blandit mus nam, libero enim hac lectus sem tempus varius sed donec imperdiet consequat. Dapibus vitae phasellus vel cursus egestas nam ad eget condimentum,',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
