<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \Illuminate\Support\Facades\DB;

class Section1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section1s')->truncate();
        DB::table('section1s')->insert([
            'title1' => 'WE ARE a DIGITAL STUDIO',
            'title2' => 'from California',
            'image' => 'home-bg.jpg',
            'lb_btn_sctn2' => 'Our Process'
        ]);
    }
}
