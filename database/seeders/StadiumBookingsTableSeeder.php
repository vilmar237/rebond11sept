<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class StadiumBookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stadium_bookings')->insert([
            'date' => "2022-06-18",
            'start' => "08:00",
            'end' => "09:00",
            'stadium_cost' => "10000",
            'status' => 'checked_out',
            'payment' => true,
            'stadium_id' => 1,
            'user_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('stadium_bookings')->insert([
            'date' => "2022-06-10",
            'start' => "13:00",
            'end' => "16:00",
            'stadium_cost' => "10000",
            'status' => 'checked_out',
            'payment' => true,
            'stadium_id' => 1,
            'user_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('stadium_bookings')->insert([
            'date' => "2022-06-16",
            'start' => "08:00",
            'end' => "09:00",
            'stadium_cost' => "10000",
            'status' => 'checked_out',
            'payment' => true,
            'stadium_id' => 1,
            'user_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('stadium_bookings')->insert([
            'date' => "2022-06-20",
            'start' => "08:00",
            'end' => "19:00",
            'stadium_cost' => "10000",
            'status' => 'checked_out',
            'payment' => true,
            'stadium_id' => 1,
            'user_id' => 4,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('stadium_bookings')->insert([
            'date' => "2022-06-21",
            'start' => "08:00",
            'end' => "21:00",
            'stadium_cost' => "10000",
            'status' => 'checked_out',
            'payment' => true,
            'stadium_id' => 1,
            'user_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('stadium_bookings')->insert([
            'date' => "2022-06-18",
            'start' => "10:00",
            'end' => "18:00",
            'stadium_cost' => "10000",
            'status' => 'checked_out',
            'payment' => true,
            'stadium_id' => 1,
            'user_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
