<?php

use Illuminate\Database\Seeder;
use Previs\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::create([
            'title' => 'super_admin'
        ]);

        $role = Role::create([
            'title' => 'admin'
        ]);

        $role = Role::create([
            'title' => 'user'
        ]);
    }
}
