<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use App\Models\Customer;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            UserSeeder::class,
            SettingsSeeder::class,
            StadiumTableSeeder::class,
            StadiumBookingsTableSeeder::class
        ]);
    }
}
