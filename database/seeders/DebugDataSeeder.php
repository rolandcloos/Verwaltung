<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DebugDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory(8)->create();
        \App\Models\Issues::factory(10)->create();

    }
}
