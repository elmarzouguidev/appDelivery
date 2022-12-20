<?php

namespace App\Policies\Sameleon;

use App\Models\Sameleon\Delivery;
use App\Models\Sameleon\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DeliveryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Authenticatable $user)
    {
        return $user->hasRole('SuperAdmin') || $user->hasRole('DeliveryEntreprise');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Delivery $delivery)
    {
        return $user->hasRole('SuperAdmin') || $delivery->hasRole('DeliveryEntreprise');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Authenticatable $user)
    {
        return $user->hasAnyRole('SuperAdmin') || $user->hasRole('DeliveryEntreprise');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Authenticatable $user, Delivery $delivery)
    {
        return $user->hasAnyRole('SuperAdmin') || $user->hasRole('DeliveryEntreprise');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Delivery $delivery)
    {
        return $user->hasAnyRole('SuperAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Delivery $delivery)
    {
        return $user->hasAnyRole('SuperAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\Delivery  $delivery
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Delivery $delivery)
    {
        return $user->hasAnyRole('SuperAdmin');
    }
}
