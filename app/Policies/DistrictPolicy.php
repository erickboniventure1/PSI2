<?php

namespace App\Policies;

use App\User;
use App\District;
use Illuminate\Auth\Access\HandlesAuthorization;

class DistrictPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can perform crud on the district.
     *
     * @param  \App\User  $user
     * @param  \App\District  $district
     * @return mixed
     */
    public function crudDistrict(User $user)
    {
        return $user->roles()->where('name', 'admin')->exists();
    }

}
