<?php

namespace App\Policies\Sameleon;


use App\Models\Sameleon\Product;
use App\Models\Sameleon\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * * @param  \App\Models\Sameleon\User  $user
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Product $product)
    {

        return $user->id == $product->user_id
            &&
            $user->uuid == $product->user_uuid || $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole('Client', 'SuperAdmin');
    }

    /**
     * Determine whether the user can update the model.
     *
     *@param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Product $product)
    {

        return $user->id == $product->user_id
            &&
            $user->uuid == $product->user_uuid || $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     *@param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Product $product)
    {
        return $user->id == $product->user_id
            &&
            $user->uuid == $product->user_uuid || $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Product $product)
    {
        return $user->id == $product->user_id
            &&
            $user->uuid == $product->user_uuid || $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Sameleon\User  $user
     * @param  \App\Models\Sameleon\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Product $product)
    {
        return $user->id == $product->user_id
            &&
            $user->uuid == $product->user_uuid || $user->hasRole('SuperAdmin');
    }

    public function import(User $user)
    {
        return $user->hasAnyRole(['Client', 'SuperAdmin', 'Admin']) ? true : false;
    }
}
