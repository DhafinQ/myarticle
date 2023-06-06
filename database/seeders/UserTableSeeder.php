<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'username' => 'Super Admin',
                'image_profile' => NULL,
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('superadmin'),
            ],
            [
                'name' => 'Admin',
                'username' => 'Admin',
                'image_profile' => NULL,
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
            ],
            [
                'name' => 'Member',
                'username' => 'Member',
                'image_profile' => NULL,
                'email' => 'member@gmail.com',
                'password' => bcrypt('member'),
            ],
        ];

        $role = ['Super Admin','Admin','Member'];

        foreach($users as $val => $user){
            $u = User::create($user);
            $u->assignRole($role[$val]);
        }
    }
}
