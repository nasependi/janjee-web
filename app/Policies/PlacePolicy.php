<?php

namespace App\Policies;

use App\Models\Place;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlacePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_place');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Place $place): bool
    {
        if ($user->hasRole('superadmin')) {
            return true;
        }

        return $user->can('view_place') && $user->id === $place->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_place');
    }

    public function update(User $user, Place $place): bool
    {
        if ($user->hasRole('superadmin')) {
            return true;
        }

        return $user->can('update_place') && $user->id === $place->user_id;
    }

    public function delete(User $user, Place $place): bool
    {
        if ($user->hasRole('superadmin')) {
            return true;
        }

        return $user->can('delete_place') && $user->id === $place->user_id;
    }
}
