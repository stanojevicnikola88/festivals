<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'title' => 'Novi Sad',
            ],
            [
                'title' => 'Beograd',
            ],
            [
                'title' => 'Zrenjanin',
            ],
            [
                'title' => 'Subotica',
            ],
            [
                'title' => 'Beč',
            ]
        ]);
    }
}
