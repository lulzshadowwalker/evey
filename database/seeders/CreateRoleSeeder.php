<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['title' => 'User'],
            ['title' => 'Admin'],
            ['title' => 'Marketing'],
            ['title' => 'Networking'],
        ];

        foreach ($roles as $key => $role) {
            Role::create($role);
        }
    }
}
