<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345678')
        ]);

        //ToDo - remove from production following users

        DB::table('users')->insert([
            'name' => 'Creator',
            'email' => 'creator@test.com',
            'password' => bcrypt('12345678')
        ]);
        DB::table('users')->insert([
            'name' => 'Reviewer',
            'email' => 'reviewer@test.com',
            'password' => bcrypt('12345678')
        ]);
        DB::table('users')->insert([
            'name' => 'Approver',
            'email' => 'approver@test.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
