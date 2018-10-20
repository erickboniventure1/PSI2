<?php

namespace App\Policies;

use App\User;
use App\IpcLeader;
use Illuminate\Auth\Access\HandlesAuthorization;

class IpcLeaderPolicy
{
    use HandlesAuthorization;

    public function crudIpcLeader(User $user)
    {
        return $user->roles()->where('name', 'admin')->exists();
    }

    /**
     * Determine whether the user can view the ipc leader.
     *
     * @param  \App\User  $user
     * @param  \App\IpcLeader  $ipcLeader
     * @return mixed
     */
    public function view(User $user, IpcLeader $ipcLeader)
    {
        //
    }

    /**
     * Determine whether the user can create ipc leaders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the ipc leader.
     *
     * @param  \App\User  $user
     * @param  \App\IpcLeader  $ipcLeader
     * @return mixed
     */
    public function update(User $user, IpcLeader $ipcLeader)
    {
        //
    }

    /**
     * Determine whether the user can delete the ipc leader.
     *
     * @param  \App\User  $user
     * @param  \App\IpcLeader  $ipcLeader
     * @return mixed
     */
    public function delete(User $user, IpcLeader $ipcLeader)
    {
        //
    }

    /**
     * Determine whether the user can restore the ipc leader.
     *
     * @param  \App\User  $user
     * @param  \App\IpcLeader  $ipcLeader
     * @return mixed
     */
    public function restore(User $user, IpcLeader $ipcLeader)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the ipc leader.
     *
     * @param  \App\User  $user
     * @param  \App\IpcLeader  $ipcLeader
     * @return mixed
     */
    public function forceDelete(User $user, IpcLeader $ipcLeader)
    {
        //
    }
}
