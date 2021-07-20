<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use app\Models\Admin;
use Hash,DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table('admins')->insert([
            'name' => 'Rishab Goyal',
            'email' => 'rishabtest01@yopmail.com',
            'password' => Hash::make('1234'),
            'role' => '0',
        ]);

    }
}
