<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
            ['user_id' => 1, 'role_id' => Role::USER],

            ['user_id' => 2, 'role_id' => Role::USER],
            ['user_id' => 2, 'role_id' => Role::ADMIN],

            ['user_id' => 3, 'role_id' => Role::USER],
            ['user_id' => 3, 'role_id' => Role::MARKETING],

            ['user_id' => 4, 'role_id' => Role::USER],
            ['user_id' => 4, 'role_id' => Role::NETWORKING],
        ]);
    }
}
