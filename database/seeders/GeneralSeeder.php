<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mains')->truncate();
        DB::table('mains')->insert([
            'name' => 'BLASTER',
            'front_url' => 'http://localhost:8000/',
        ]);

        DB::table('front_previews')->truncate();
        DB::table('front_previews')->insert([
            'url' => 'http://localhost:8000/',
        ]);

        DB::table('navbars')->truncate();
        DB::table('navbars')->insert([
            'item1' => 'INICIO',
            'item2' => 'NOSOTROS',
            'item3' => 'PORTAFOLIO',
            'item4' => 'EQUIPO',
            'item5' => 'PRODUCTOS',
            'item6' => 'CONTACTO',
            'chk1' => '1',
            'chk2' => '1',
            'chk3' => '1',
            'chk4' => '1',
            'chk5' => '1',
            'chk6' => '1',
        ]);

        DB::table('footers')->truncate();
        DB::table('footers')->insert([
            'symbol' => 'Copyright ©',
            'year' => '2084',
            'owner' => 'Blaster Studio',
            'link' => 'http://www.templatemo.com',
            'name_link' => 'templatemo',
            'image' => 'footer-bg.jpg',
            'other_details' => 'Design:',
        ]);

        DB::table('social_networks')->truncate();
        DB::table('social_networks')->insert([
            [
                'name' => 'facebook',
                'image' => 'facebook.gif',
                'url' => 'http://www.facebook.com/templatemo',
            ],
            [
                'name' => 'twitter',
                'image' => 'twitter.gif',
                'url' => '#',
            ],
            [
                'name' => 'behance',
                'image' => 'behance.gif',
                'url' => '#',
            ],
            [
                'name' => 'dribbble',
                'image' => 'dribbble.gif',
                'url' => '#',
            ],
            [
                'name' => 'github',
                'image' => 'github.gif',
                'url' => '#',
            ],
        ]);
    }
}
