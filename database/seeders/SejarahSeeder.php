<?php

namespace Database\Seeders;

use App\Models\Sejarah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SejarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sejarah::create([
            'description' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit gravida congue rhoncus, inceptos molestie ridiculus hendrerit montes vivamus blandit aenean sollicitudin eros, nunc phasellus dictumst et tempus tempor fringilla fermentum euismod. A proin fringilla et nostra magna venenatis, sollicitudin facilisi montes himenaeos nam, nascetur luctus etiam diam tempor. Ridiculus neque dapibus porta vestibulum semper, tempus mattis venenatis ornare, nulla eros sollicitudin suscipit. Vestibulum eros viverra fermentum enim aptent nascetur vulputate, sollicitudin sed magnis non auctor interdum nibh velit, cursus feugiat pretium vehicula sociosqu arcu. Enim accumsan bibendum risus dui ante litora augue, aliquet primis parturient interdum venenatis integer in, vitae quis scelerisque egestas nec hac.
            Hendrerit curae nisi vulputate justo odio morbi magnis at ornare, aliquam tempor aenean taciti duis nulla ultrices fringilla, imperdiet fermentum turpis sollicitudin inceptos congue pellentesque eros. Etiam cum vitae ligula volutpat convallis mattis orci nisl, consequat placerat potenti aenean nec auctor. Rhoncus in curabitur euismod nullam mus fames, cras tincidunt dis ante parturient ac, malesuada augue senectus vestibulum lacinia. Mi dictumst quis nostra nisl commodo mauris leo volutpat congue lectus per litora nibh, facilisi et rutrum inceptos ullamcorper a id nunc at nascetur sodales. Dui pulvinar quam eleifend montes natoque id mus potenti, netus dictumst vel praesent facilisi mauris pharetra, duis leo platea sodales vulputate per convallis. Torquent etiam molestie cursus nisl mus cubilia blandit fringilla, velit potenti mauris fermentum feugiat imperdiet mattis libero, nullam tellus accumsan hac proin interdum eget. Mi blandit congue nullam maecenas ornare sollicitudin nec senectus aptent, euismod pharetra fermentum habitasse inceptos egestas parturient sapien, habitant turpis cras non torquent curae commodo primis. Rutrum turpis potenti gravida semper molestie senectus donec pharetra imperdiet sagittis facilisi pulvinar, laoreet sociis tincidunt taciti nec class tortor vitae nascetur vehicula.',
            'img' => 'example.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
