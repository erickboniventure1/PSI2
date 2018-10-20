<?php

namespace App\Policies;

use App\User;
use App\Region;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegionPolicy
{
    use HandlesAuthorization;

    public function crudRegion(User $user)
    {
        return $user->roles()->where('name', 'admin')->exists();
    }

    /**
     * Determine whether the user can view the region.
     *
     * @param  \App\User  $user
     * @param  \App\Region  $region
     * @return mixed
     */
    public function view(User $user, Region $region)
    {
        //
    }

    /**
     * Determine whether the user can create regions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the region.
     *
     * @param  \App\User  $user
     * @param  \App\Region  $region
     * @return mixed
     */
    public function update(User $user, Region $region)
    {
        //
    }

    /**
     * Determine whether the user can delete the region.
     *
     * @param  \App\User  $user
     * @param  \App\Region  $region
     * @return mixed
     */
    public function delete(User $user, Region $region)
    {
        //
    }

    /**
     * Determine whether the user can restore the region.
     *
     * @param  \App\User  $user
     * @param  \App\Region  $region
     * @return mixed
     */
    public function restore(User $user, Region $region)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the region.
     *
     * @param  \App\User  $user
     * @param  \App\Region  $region
     * @return mixed
     */
    public function forceDelete(User $user, Region $region)
    {
        //
    }
}
