<?php

use Illuminate\Database\Seeder;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\DB;
>>>>>>> upstream/master

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
<<<<<<< HEAD
            'role_name' => 'organizer',
        ]);
        DB::table('roles')->insert([
            'role_name' => 'participant',
        ]);
        DB::table('roles')->insert([
            'role_name' => 'referee',
=======
           [
               'id' => 1,
               'name' => 'organizer'
           ],
            [
                'id' => 2,
                'name' => 'participant'
            ]
>>>>>>> upstream/master
        ]);
    }
}
