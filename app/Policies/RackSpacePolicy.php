<?php

namespace App\Policies;

use App\Models\RackSpace;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RackSpacePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // public function update(User $user, RackSpace $rackSpace)
    // {
    //     // the following checks are performed and if any one is true then the user is authorized to edit the rack$rackSpace
    //     // 1. if the user is the owner of the rack$rackSpace then he can edit it
    //     // 2. if the user->owner_id is the same as the rack$rackSpace->user_id then he can edit it provided he has the permission 'update'
    //     return $user->id === $rackSpace->user_id ||
    //         ($user->owner_id === $rackSpace->user_id &&
    //             $user->hasPermissionTo('update'));
    // }
}
