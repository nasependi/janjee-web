<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            ['name' => 'superadmin'],
            ['name' => 'admin'],
        ];
        foreach ($role as $value) {
            Role::updateOrCreate([
                'name' => $value['name']
            ]);
        }
    }
}
