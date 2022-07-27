<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->delete();

        DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1');

        $allPermissions = Permission::all();

        $admin = new Role();
        $admin->name = 'Super';
        $admin->guard_name = 'web';
        $admin->created_at = '2022-07-26 09:12:31';
        $admin->updated_at = '2022-07-26 09:12:31';
        $admin->save();

        $employee = new Role();
        $employee->name = 'Admin';
        $employee->guard_name = 'web';
        $employee->created_at = '2022-07-26 09:12:31';
        $employee->updated_at = '2022-07-26 09:12:31';
        $employee->save();

        $client = new Role();
        $client->name = 'Customer';
        $client->guard_name = 'web';
        $client->created_at = '2022-07-26 09:12:31';
        $client->updated_at = '2022-07-26 09:12:31';
        $client->save();

        $admin->syncPermissions($allPermissions);

        /*$admin->perms()->sync([]);
        $admin->attachPermissions($allPermissions);*/

        /*$employee->perms()->sync([]);
        $employee->attachPermissions($allPermissions);

        $client->perms()->sync([]);
        $client->attachPermissions($allPermissions);*/
    }
}
