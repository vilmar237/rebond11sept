<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stadium;

class StadiumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stadium::factory()->count(1)->create();
    }
}
