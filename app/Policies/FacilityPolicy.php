<?php

namespace App\Policies;

use App\User;
use App\Facility;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacilityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the facility.
     *
     * @param  \App\User  $user
     * @param  \App\Facility  $facility
     * @return mixed
     */
    public function crudFacility(User $user)
    {
        return $user->roles()->where('name', 'admin')
                             ->exists();
    }

    /**
     * Determine whether the user can create facilities.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->roles()->where('name', 'admin')
                             ->orWhere('name', 'ipc_leader')
                             ->exists();
    }

    /**
     * Determine whether the user can update the facility.
     *
     * @param  \App\User  $user
     * @param  \App\Facility  $facility
     * @return mixed
     */
    public function update(User $user, Facility $facility)
    {

    }

    /**
     * Determine whether the user can delete the facility.
     *
     * @param  \App\User  $user
     * @param  \App\Facility  $facility
     * @return mixed
     */
    public function delete(User $user, Facility $facility)
    {

    }

     /**
     * Determine whether the user can restore the facility.
     *
     * @param  \App\User  $user
     * @param  \App\Facility  $facility
     * @return mixed
     */
    public function restore(User $user, Facility $facility)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the facility.
     *
     * @param  \App\User  $user
     * @param  \App\Facility  $facility
     * @return mixed
     */
    public function forceDelete(User $user, Facility $facility)
    {
        //
    }
}
