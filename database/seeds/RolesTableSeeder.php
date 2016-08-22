<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'Webmaster',
        ]);
        $role = Role::create([
            'name' => 'Admin',
        ]);
        $role = Role::create([
            'name' => 'Mod',
        ]);
        $role = Role::create([
            'name' => 'Member',
        ]);
    }
}
