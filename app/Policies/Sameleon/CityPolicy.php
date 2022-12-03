<?php

namespace App\Policies\Sameleon;

use App\Models\Sameleon\City;
use App\Models\Sameleon\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CityPolicy
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
        return $user->hasAnyRole('Admin', 'SuperAdmin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, City $city)
    {
        return $user->hasAnyRole('Admin', 'SuperAdmin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole('Admin', 'SuperAdmin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, City $city)
    {
        return $user->hasAnyRole('Admin', 'SuperAdmin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, City $city)
    {
        return $user->hasAnyRole('SuperAdmin') && $city->id !== 1 && $city->slug !== 'casablanca'
            ? Response::allow()
            : Response::deny("Vous ne pouvez pas supprimer la ville $city->slug");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, City $city)
    {
        return $user->hasAnyRole('SuperAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\City  $city
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, City $city)
    {
        return $user->hasAnyRole('SuperAdmin') && $city->id !== 1 && $city->slug !== 'casablanca'
            ? Response::allow()
            : Response::deny("Vous ne pouvez pas supprimer la ville $city->slug");
    }
}
