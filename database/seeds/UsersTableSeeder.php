<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Superadmin',
            'email' => 'superadmin@admin.com',
            'password' => bcrypt('superadmin'),
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('administrator'),
            'role' => 2
        ]);
        DB::table('users')->insert([
            'name' => 'Global User',
            'email' => 'user@user.com',
            'password' => bcrypt('globaluser'),
            'role' => 3
        ]);
    }
}
