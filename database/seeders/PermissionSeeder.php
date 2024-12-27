<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            ['name' => 'view_booking', 'guard_name' => 'web'],
            ['name' => 'view_any_booking', 'guard_name' => 'web'],
            ['name' => 'create_booking', 'guard_name' => 'web'],
            ['name' => 'update_booking', 'guard_name' => 'web'],
            ['name' => 'restore_booking', 'guard_name' => 'web'],
            ['name' => 'restore_any_booking', 'guard_name' => 'web'],
            ['name' => 'replicate_booking', 'guard_name' => 'web'],
            ['name' => 'reorder_booking', 'guard_name' => 'web'],
            ['name' => 'delete_booking', 'guard_name' => 'web'],
            ['name' => 'delete_any_booking', 'guard_name' => 'web'],
            ['name' => 'force_delete_booking', 'guard_name' => 'web'],
            ['name' => 'force_delete_any_booking', 'guard_name' => 'web'],
            ['name' => 'view_field', 'guard_name' => 'web'],
            ['name' => 'view_any_field', 'guard_name' => 'web'],
            ['name' => 'create_field', 'guard_name' => 'web'],
            ['name' => 'update_field', 'guard_name' => 'web'],
            ['name' => 'restore_field', 'guard_name' => 'web'],
            ['name' => 'restore_any_field', 'guard_name' => 'web'],
            ['name' => 'replicate_field', 'guard_name' => 'web'],
            ['name' => 'reorder_field', 'guard_name' => 'web'],
            ['name' => 'delete_field', 'guard_name' => 'web'],
            ['name' => 'delete_any_field', 'guard_name' => 'web'],
            ['name' => 'force_delete_field', 'guard_name' => 'web'],
            ['name' => 'force_delete_any_field', 'guard_name' => 'web'],
            ['name' => 'view_place', 'guard_name' => 'web'],
            ['name' => 'view_any_place', 'guard_name' => 'web'],
            ['name' => 'create_place', 'guard_name' => 'web'],
            ['name' => 'update_place', 'guard_name' => 'web'],
            ['name' => 'restore_place', 'guard_name' => 'web'],
            ['name' => 'restore_any_place', 'guard_name' => 'web'],
            ['name' => 'replicate_place', 'guard_name' => 'web'],
            ['name' => 'reorder_place', 'guard_name' => 'web'],
            ['name' => 'delete_place', 'guard_name' => 'web'],
            ['name' => 'delete_any_place', 'guard_name' => 'web'],
            ['name' => 'force_delete_place', 'guard_name' => 'web'],
            ['name' => 'force_delete_any_place', 'guard_name' => 'web'],
            ['name' => 'view_role', 'guard_name' => 'web'],
            ['name' => 'view_any_role', 'guard_name' => 'web'],
            ['name' => 'create_role', 'guard_name' => 'web'],
            ['name' => 'update_role', 'guard_name' => 'web'],
            ['name' => 'delete_role', 'guard_name' => 'web'],
            ['name' => 'delete_any_role', 'guard_name' => 'web'],
            ['name' => 'view_user', 'guard_name' => 'web'],
            ['name' => 'view_any_user', 'guard_name' => 'web'],
            ['name' => 'create_user', 'guard_name' => 'web'],
            ['name' => 'update_user', 'guard_name' => 'web'],
            ['name' => 'restore_user', 'guard_name' => 'web'],
            ['name' => 'restore_any_user', 'guard_name' => 'web'],
            ['name' => 'replicate_user', 'guard_name' => 'web'],
            ['name' => 'reorder_user', 'guard_name' => 'web'],
            ['name' => 'delete_user', 'guard_name' => 'web'],
            ['name' => 'delete_any_user', 'guard_name' => 'web'],
            ['name' => 'force_delete_user', 'guard_name' => 'web'],
            ['name' => 'force_delete_any_user', 'guard_name' => 'web'],
            ['name' => 'view_event', 'guard_name' => 'web'],
            ['name' => 'view_any_event', 'guard_name' => 'web'],
            ['name' => 'create_event', 'guard_name' => 'web'],
            ['name' => 'update_event', 'guard_name' => 'web'],
            ['name' => 'restore_event', 'guard_name' => 'web'],
            ['name' => 'restore_any_event', 'guard_name' => 'web'],
            ['name' => 'replicate_event', 'guard_name' => 'web'],
            ['name' => 'reorder_event', 'guard_name' => 'web'],
            ['name' => 'delete_event', 'guard_name' => 'web'],
            ['name' => 'delete_any_event', 'guard_name' => 'web'],
            ['name' => 'force_delete_event', 'guard_name' => 'web'],
            ['name' => 'force_delete_any_event', 'guard_name' => 'web'],
            ['name' => 'widget_AStatsOverview', 'guard_name' => 'web'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate($permission);
        }

        $roleSuperAdmin = Role::where('name','superadmin')->first();
        $roleAdmin = Role::where('name','admin')->first();

        $allPermissions = Permission::all();

        $bookingAndFieldPermissions = Permission::where('name', 'like', '%booking%')
            ->orWhere('name', 'like', '%field%')
            ->get();

        $roleSuperAdmin->syncPermissions($allPermissions);

        $roleAdmin->syncPermissions($bookingAndFieldPermissions);
    }
}