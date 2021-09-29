<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'title' => 'Exit Festival',
                'start' => '2022-07-10 18:00:00',
                'end' => '2022-07-13 06:00:00',
                'country_id' => 1,
                'city_id' => 1,
                'address' => 'Petrovaradinska bb',
                'latitude' => '123',
                'longitude' => '456',
                'featured_image' => 'exit.jpg',
                'description' => 'Exit is a summer music festival which is held at the Petrovaradin Fortress in Novi Sad, Serbia. Founded in 2000, it has twice won the Best Major Festival award at the European Festivals Awards, for 2013 and 2017.'
            ],
            [
                'title' => 'Volt Festival',
                'start' => '2022-08-10 18:00:00',
                'end' => '2022-08-13 03:00:00',
                'country_id' => 2,
                'city_id' => 5,
                'address' => 'Vienna street 12',
                'latitude' => '789',
                'longitude' => '654',
                'featured_image' => 'volt.jpg',
                'description' => 'VOLT festival is a multi-genre festival in Vienna Austria. Getting its title from the pop culture magazine of the same name, the festival has been running...'
            ],
        ]);
    }
}
