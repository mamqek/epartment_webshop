<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            'name' => 'PLAYSEAT Evolution Pro - Red Bull Racing eSports Foldable Racing Seat',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eu lacus at eros ullamcorper consectetur. Donec arcu risus, aliquet eu odio eu, aliquam pretium lacus. Donec pellentesque ipsum dignissim risus lobortis tincidunt. Cras molestie tempor mauris, nec rutrum orci sodales nec. Nunc tristique ultrices leo. Morbi tincidunt diam ut maximus iaculis. Fusce interdum tincidunt est egestas lacinia. Vestibulum nec urna at orci pulvinar venenatis quis convallis velit. Nullam nec augue at diam pellentesque volutpat. Integer id diam gravida, aliquet arcu accumsan, consectetur nisi.',
            'image' => 'images/seat.png',
            'extra_option' => 5.55,
        ]);
    }
}
