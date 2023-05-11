<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Disable foreign key checks for current db driver
        DB::statement('PRAGMA foreign_keys = ON;');

        $this->call(GeneralSeeder::class);
        $this->call(Section1Seeder::class);
        $this->call(Section2Seeder::class);
        $this->call(Section3Seeder::class);
        $this->call(Section4Seeder::class);
        $this->call(Section5Seeder::class);
        $this->call(Section6Seeder::class);
        $this->call(UserSeeder::class);

        //Enable foreign key checks for current db driver
        DB::statement('PRAGMA foreign_keys = OFF;');
    }
}
