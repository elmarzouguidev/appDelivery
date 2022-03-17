<?php

namespace App\Policies\Sameleon;

use App\Models\Sameleon\Client;
use App\Models\Sameleon\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * * @param  \App\Models\Sameleon\Client  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Client $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Sameleon\Client  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Client $user, Product $product)
    {

        return $user->id === $product->client_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Sameleon\Client  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Client $user)
    {
        return $user->hasAnyRole('Client', 'SuperAdmin');
    }

    /**
     * Determine whether the user can update the model.
     *
     *@param  \App\Models\Sameleon\Client  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Client $user, Product $product)
    {

        return $user->id === $product->client_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     *@param  \App\Models\Sameleon\Client  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Client $user, Product $product)
    {
        return $user->id === $product->client_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Client $user, Product $product)
    {
        return $user->id === $product->client_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Client $user, Product $product)
    {
        return $user->id === $product->client_id;
    }
}
