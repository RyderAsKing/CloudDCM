<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = ['admin', 'user', 'subuser'];

        foreach ($roles as $role) {
            if (!Role::where('name', $role)->first()) {
                Role::create(['name' => $role]);
            } else {
                echo "Role $role already exists.\n";
            }
        }
    }
}
