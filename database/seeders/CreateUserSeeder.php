<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Amber Terry',
                'email' => 'user@email.com',
                'phone' => '0777777777',
                'avatar' => 'images/Amber-Terry.jpg',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Madeson Fischer',
                'email' => 'admin@email.com',
                'phone' => '0788888888',
                'avatar' => 'images/Madeson-Fischer.jpg',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Nora Harrington',
                'email' => 'marketing@email.com',
                'phone' => '0799999999',
                'avatar' => 'images/Nora-Harrington.jpg',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Alan Blanchard',
                'email' => 'networking@email.com',
                'phone' => '0778888888',
                'avatar' => 'images/Alan-Blanchard.jpg',
                'password' => bcrypt('123456'),
            ],

        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
