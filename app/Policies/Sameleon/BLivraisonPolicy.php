<?php

namespace App\Policies\Sameleon;

use App\Models\Sameleon\BLivraison;
use App\Models\Sameleon\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BLivraisonPolicy
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
        return $user->hasAnyRole('Admin','SuperAdmin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\BLivraison  $bLivraison
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, BLivraison $bLivraison)
    {
        return $bLivraison->client()->is($user) || $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole('Admin','SuperAdmin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\BLivraison  $bLivraison
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, BLivraison $bLivraison)
    {
        return $bLivraison->client()->is($user) || $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\BLivraison  $bLivraison
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, BLivraison $bLivraison)
    {
        return  $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\BLivraison  $bLivraison
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, BLivraison $bLivraison)
    {
        return  $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\BLivraison  $bLivraison
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, BLivraison $bLivraison)
    {
       $user->hasRole('SuperAdmin');
    }
}
