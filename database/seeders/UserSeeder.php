<?php

namespace Database\Seeders;

use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        $usr = User::create([
            'first_name' => 'Cyrille',
            'last_name' => 'MBIA',
            'email' => 'mbia1378@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Super',
            'status' => TRUE,
            'about' => "hello from the other world",
            'address' => "Yaoundé",
            'phone' => "695035506",
            'gender' => "male",
            'random_key' => Str::random(60)
        ]);

        User::factory()->count(10)->create();

        $Permissions = Permission::all();
        $usr->syncPermissions($Permissions);

        $role = Role::where('name', 'Super')->first();
        $usr->syncRoles($role);

        $role->givePermissionTo($Permissions);
    }
}
