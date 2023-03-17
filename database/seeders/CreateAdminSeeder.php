<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Hash;
use Spatie\Permission\Models\Role;


class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'email' => 'admin@email.ru',
            'name' => 'Admin',
            'password' => Hash::make('1234567890'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $role = Role::create([
            'name' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $role->syncPermissions('read users', 'create users', 'edit users', 'delete users',
            'read roles', 'create roles', 'edit roles', 'delete roles',
            'read permissions', 'create permissions', 'edit permissions', 'delete permissions',
            'read records', 'create records', 'edit records', 'delete records');

        $admin->assignRole('admin');


        $role = Role::create([
            'name' => 'moderator',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $role->syncPermissions('read users', 'read roles','read permissions', 'read records', 'create records', 'edit records', 'delete records');


        $role = Role::create([
            'name' => 'user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $role->givePermissionTo('read records');



    }
}
