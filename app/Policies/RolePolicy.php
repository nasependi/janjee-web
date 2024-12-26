<?php
// app/Policies/RolePolicy.php
namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_role');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->can('view_role');
    }

    public function create(User $user): bool
    {
        return $user->can('create_role');
    }

    public function update(User $user, Role $role): bool
    {
        // Super admin tidak bisa diedit kecuali oleh super admin
        if ($role->name === 'superadmin' && !$user->hasRole('superadmin')) {
            return false;
        }
        return $user->can('update_role');
    }

    public function delete(User $user, Role $role): bool
    {
        // Role superadmin dan admin tidak bisa dihapus
        if (in_array($role->name, ['superadmin', 'admin'])) {
            return false;
        }
        return $user->can('delete_role');
    }
}
