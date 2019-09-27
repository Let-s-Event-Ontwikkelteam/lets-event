<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name' => 'organizer',
        ]);
        DB::table('roles')->insert([
            'role_name' => 'participant',
        ]);
        DB::table('roles')->insert([
            'role_name' => 'referee',
        ]);
    }
}
