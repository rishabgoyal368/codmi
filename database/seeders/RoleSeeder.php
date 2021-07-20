<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'USER',
            'permissions' => serialize(
                array(
                    'users' => 'users',
                    'dashboard' => 'dashboard',
                    'logout' => 'logout',
                ),
            ),
        ]);
        Role::create([
            'name' => 'RELATILOR',
            'permissions' => serialize(array(
                'retails' => 'retails',
                'dashboard' => 'dashboard'
            )),
        ]);
    }
}
