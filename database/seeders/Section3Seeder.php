<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \Illuminate\Support\Facades\DB;

class Section3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section3s')->truncate();
        DB::table('section3s')->insert([
            'description' => 'MOBILE, WEB AND BRAND IDENTITY'
        ]);

        DB::table('section3_categories')->truncate();
        DB::table('section3_categories')->insert([
            [
                'name' => 'HTML'
            ],
            [
                'name' => 'PHOTOSHOP'
            ],
            [
                'name' => 'WORDPRESS'
            ],
            [
                'name' => 'MOBILE'
            ]
        ]);

        DB::table('section3_category_images')->truncate();
        DB::table('section3_category_images')->insert([
            [
                'section3_category_id' => 2,
                'image' => 'portfolio-img5.jpg'
            ],
            [
                'section3_category_id' => 1,
                'image' => 'portfolio-img1.jpg'
            ],
            [
                'section3_category_id' => 1,
                'image' => 'portfolio-img3.jpg'
            ],
            [
                'section3_category_id' => 1,
                'image' => 'portfolio-img5.jpg'
            ],
            [
                'section3_category_id' => 2,
                'image' => 'portfolio-img6.jpg'
            ],
            [
                'section3_category_id' => 2,
                'image' => 'portfolio-img7.jpg'
            ],
            [
                'section3_category_id' => 2,
                'image' => 'portfolio-img8.jpg'
            ],
            [
                'section3_category_id' => 3,
                'image' => 'portfolio-img1.jpg'
            ],
            [
                'section3_category_id' => 3,
                'image' => 'portfolio-img2.jpg'
            ],
            [
                'section3_category_id' => 3,
                'image' => 'portfolio-img4.jpg'
            ],
            [
                'section3_category_id' => 3,
                'image' => 'portfolio-img9.jpg'
            ],
            [
                'section3_category_id' => 4,
                'image' => 'portfolio-img1.jpg'
            ],
            [
                'section3_category_id' => 4,
                'image' => 'portfolio-img3.jpg'
            ],
            [
                'section3_category_id' => 4,
                'image' => 'portfolio-img7.jpg'
            ],
            [
                'section3_category_id' => 4,
                'image' => 'portfolio-img8.jpg'
            ],
            [
                'section3_category_id' => 4,
                'image' => 'portfolio-img9.jpg'
            ]
        ]);
    }
}
