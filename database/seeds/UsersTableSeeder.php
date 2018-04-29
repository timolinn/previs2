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
    }
}
