<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Jon',
                'last_name' => 'Doe',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'is_admin' => 1,
                'created_at' => '2021-09-28 18:56:54',
                'updated_at' => '2021-09-28 18:56:54'
            ],
            [
                'first_name' => 'Mark',
                'last_name' => 'Twain',
                'email' => 'mark@gmail.com',
                'password' => Hash::make('password'),
                'is_admin' => 0,
                'created_at' => '2021-09-28 18:56:54',
                'updated_at' => '2021-09-28 18:56:54'
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Silver',
                'email' => 'john@gmail.com',
                'password' => Hash::make('password'),
                'is_admin' => 0,
                'created_at' => '2021-09-28 18:56:54',
                'updated_at' => '2021-09-28 18:56:54'
            ],
            [
                'first_name' => 'Tom',
                'last_name' => 'Golden',
                'email' => 'tom@gmail.com',
                'password' => Hash::make('password'),
                'is_admin' => 0,
                'created_at' => '2021-09-28 18:56:54',
                'updated_at' => '2021-09-28 18:56:54'
            ],
            [
                'first_name' => 'Alex',
                'last_name' => 'Ward',
                'email' => 'alex@gmail.com',
                'password' => Hash::make('password'),
                'is_admin' => 0,
                'created_at' => '2021-09-28 18:56:54',
                'updated_at' => '2021-09-28 18:56:54'
            ]
        ]);
    }
}
