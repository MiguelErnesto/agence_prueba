<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \Illuminate\Support\Facades\DB;

class Section2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section2s')->truncate();
        DB::table('section2s')->insert([
            'description' => 'WE ARE TALANTED DESIGNERS & DEVELOPERS'
        ]);

        DB::table('section2_imgs')->truncate();
        DB::table('section2_imgs')->insert([
            [
                'image' => 'fa-cloud.jpg',
                'title' => 'Planning',
                'description' => 'Blaster is free responsive layout from templatemo. Credit goes to Pixabay for images. You can change icons by looking at FontAwesome icons. Thank you for visiting our website.'
            ],
            [
                'image' => 'fa-computer.jpg',
                'title' => 'Developing',
                'description' => 'Example: <i class="fa fa-phone"></i> for phone icon. <i class="fa fa-mobile"></i> for mobile icon. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.'
            ],
            [
                'image' => 'fa-globe.jpg',
                'title' => 'Launching',
                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteu sunt in culpa qui officia deserunt mollit anim id.'
            ]
        ]);
    }
}
