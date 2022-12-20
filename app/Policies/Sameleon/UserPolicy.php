<?php

namespace App\Policies\Sameleon;

use App\Models\Sameleon\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        return $user->hasAnyRole('SuperAdmin', 'Admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        return $user->hasAnyRole('SuperAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        return $user->hasAnyRole('SuperAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        return $user->hasAnyRole('SuperAdmin');
    }
}
