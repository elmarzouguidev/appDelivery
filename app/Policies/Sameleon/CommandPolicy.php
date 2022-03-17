<?php

namespace App\Policies\Sameleon;

use App\Models\Sameleon\Client;
use App\Models\Sameleon\Command;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommandPolicy
{
    use HandlesAuthorization;


    /*public function before(User $user, $ability)
    {
        if ($user->hasRole('SuperAdmin')) {
            return true;
        }
    }*/

    /**
     * Determine whether the user can view any models.
     *

     */
    public function viewAny(Authenticatable $user)
    {
        return $user->hasAnyRole('Client', 'SuperAdmin');
    }

    /**
     * Determine whether the user can view the model.
     *

     */
    public function view(Authenticatable $user, Command $command)
    {
        return $user->hasRole('Client');
    }

    /**
     * Determine whether the user can create models.
     *

     */
    public function create(Client $user)
    {
        return $user->hasRole('Client')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de crée une command.");
    }


    public function update(Authenticatable $user, Command $command)
    {
       
        //dd($user,$command);
        return $command->client()->is($user) || $user->hasRole('SuperAdmin')
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation d'accéder à cette command.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Sameleon\Client  $user
     * @param  \App\Models\Sameleon\Command  $command
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Authenticatable $user, Command $command)
    {
        return $command->client()->is($user)
            ? Response::allow()
            : Response::deny("désolé vous n'avez pas l'autorisation de supprimer à cette command.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     *@param  \App\Models\Sameleon\Client  $user
     * @param  \App\Models\Sameleon\Command  $command
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Authenticatable $user, Command $command)
    {
        return $command->client()->is($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Sameleon\Client  $user
     * @param  \App\Models\Sameleon\Command  $command
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Client $user, Command $command)
    {
        return $command->client()->is($user);
    }
}
