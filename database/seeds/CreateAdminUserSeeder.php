<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            [
                'name' => 'Achmad Joko Priyono',
                'email' => 'achmadjp7@gmail.com',
                'password' => bcrypt('secret')
            ]
        );

        $superAdminRole = Role::where('name', 'superadmin')->first();

        $user->assignRole([$superAdminRole->id]);
    }
}
