<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 5; $i++) {
            $userRoles = new UserRole();
            $userRoles->user_id = 1;
            $userRoles->role_id = $i;
            $userRoles->save();
        }

        $users = User::get();
        $roles = Role::select('id')->get()->toArray();
        foreach ($users as $user) {
            $numberOfRoles = rand(-3, 3);
            $numberOfRoles = $numberOfRoles < 1 ? 1 : $numberOfRoles;

            if ($numberOfRoles == 1) {
                $userRoles = new UserRole();
                $userRoles->user_id = $user->id;
                $userRoles->role_id = 4;
                $userRoles->save();
            }
            if ($numberOfRoles == 2) {
                for ($i=3; $i < 5; $i++) {
                    $userRoles = new UserRole();
                    $userRoles->user_id = $user->id;
                    $userRoles->role_id = $i;
                    $userRoles->save();
                }
            }
            if ($numberOfRoles == 3) {
                for ($i=2; $i < 5; $i++) {
                    $userRoles = new UserRole();
                    $userRoles->user_id = $user->id;
                    $userRoles->role_id = $i;
                    $userRoles->save();
                }
            }
        }
    }
}
