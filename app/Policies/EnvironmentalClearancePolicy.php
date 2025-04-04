<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EnvironmentalClearance;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnvironmentalClearancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_environmental::clearance');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EnvironmentalClearance $environmentalClearance): bool
    {
        return $user->can('view_environmental::clearance');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_environmental::clearance');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EnvironmentalClearance $environmentalClearance): bool
    {
        return $user->can('update_environmental::clearance');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EnvironmentalClearance $environmentalClearance): bool
    {
        return $user->can('delete_environmental::clearance');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_environmental::clearance');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, EnvironmentalClearance $environmentalClearance): bool
    {
        return $user->can('force_delete_environmental::clearance');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_environmental::clearance');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, EnvironmentalClearance $environmentalClearance): bool
    {
        return $user->can('restore_environmental::clearance');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_environmental::clearance');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, EnvironmentalClearance $environmentalClearance): bool
    {
        return $user->can('replicate_environmental::clearance');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_environmental::clearance');
    }
}
