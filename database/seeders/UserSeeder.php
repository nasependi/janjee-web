<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesData = [
            ['name' => 'Admin Sudirman', 'email' => 'sudirman@mail.com', 'phone_number' => '089639854369'],
            ['name' => 'Super Admin', 'email' => 'superadmin@mail.com', 'phone_number' => '089639854369'],
        ];

        foreach ($rolesData as $role) {
            $user = User::updateOrCreate([
                'name' => $role['name'],
                'email' => $role['email'],
            ], [
                'phone_number' => $role['phone_number'],
                'password' => bcrypt('password')
            ]);

            if ($role['name'] == 'Super Admin') {
                $user->assignRole('superadmin');
            } else {
                $user->assignRole('admin');
            }
        }
    }
}
