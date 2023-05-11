<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \Illuminate\Support\Facades\DB;

class Section4Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section4s')->truncate();
        DB::table('section4s')->insert([
            'description' => 'CREATIVE TALENTS FROM WEST COAST'
        ]);

        DB::table('section4_images')->truncate();
        DB::table('section4_images')->insert([
            [
                'name' => 'Tracy',
                'role' => 'Designer',
                'image' => 'team1.jpg'
            ],
            [
                'name' => 'Linda',
                'role' => 'Manager',
                'image' => 'team2.jpg'
            ],
            [
                'name' => 'Mary',
                'role' => 'Developer',
                'image' => 'team3.jpg'
            ],
        ]);
    }
}
