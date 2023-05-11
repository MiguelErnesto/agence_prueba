<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \Illuminate\Support\Facades\DB;

class Section6Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section6s')->truncate();
        DB::table('section6s')->insert([
            'description' => 'WE LOVE PRETTY MUCH TO HEAR FROM YOU',
            'phone' => '060-040-0640',
            'email' => 'info@company.com',
            'location' => 'San Francisco, California'
        ]);
    }
}
