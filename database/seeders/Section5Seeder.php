<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \Illuminate\Support\Facades\DB;

class Section5Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section5s')->truncate();
        DB::table('section5s')->insert([
            'description' => 'WE LOVE PRETTY MUCH TO HEAR FROM YOU'
        ]);

        DB::table('section5_tablas')->truncate();
        DB::table('section5_tablas')->insert([
            [
                'section3_category_id' => '2',
                'elemento' => 'Teclado',
                'descripcion' => 'Teclado de computadora',
                'cantidad' => '5',
                'precio' => '4',
                'importe' => '20',
                'u_m' => '3'
            ],
            [
                'section3_category_id' => '1',
                'elemento' => 'Mesa',
                'descripcion' => 'Mesa de escritorio plegable',
                'cantidad' => '5',
                'precio' => '6',
                'importe' => '30',
                'u_m' => 'caja'
            ],
            [
                'section3_category_id' => '3',
                'elemento' => 'Jarra',
                'descripcion' => 'Jarra para chocolate caliente',
                'cantidad' => '5',
                'precio' => '7',
                'importe' => '35',
                'u_m' => 'caja'
            ],
            [
                'section3_category_id' => '4',
                'elemento' => 'Queso',
                'descripcion' => 'Queso italiano',
                'cantidad' => '5',
                'precio' => '5',
                'importe' => '25',
                'u_m' => 'gramos'
            ],
        ]);
    }
}
