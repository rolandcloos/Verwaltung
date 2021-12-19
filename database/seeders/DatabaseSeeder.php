<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('roles')->insert(
            [
                ['name' => 'admin'],
                ['name' => 'client'],
                ['name' => 'user'],
            ]
        );

// TODO: DebugDataSeeder only for DEBUG Mode !!!
        $this->call(
            [
                DebugDataSeeder::class,
            ]
        );
    }
}
