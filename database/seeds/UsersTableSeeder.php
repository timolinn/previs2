<?php

use Illuminate\Database\Seeder;
use Previs\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Timothy',
            'user_name' => 'timolinn',
            'last_name' => 'Onyiuke',
            'email' => 'fabrobocomx@gmail.com',
            'role_id' => 1,
            'phone_number' => '08130887771',
            'password' => \Hash::make('password')
        ]);

        $user = User::create([
            'first_name' => 'Tommy',
            'user_name' => 'tommyleejones',
            'last_name' => 'Jones',
            'email' => 'xaviertim017@gmail.com',
            'role_id' => 3,
            'phone_number' => '08130887774',
            'password' => \Hash::make('password')
        ]);
    }
}
