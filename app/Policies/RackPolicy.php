<?php

namespace App\Policies;

use App\Models\Rack;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RackPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        // if user is a subuser then get the owner of the user and check if the owner has the role 'colocation_manager'
        // if yes then return null so that the user can perform all the actions
        // else return false so that the user cannot perform any action

        if ($user->hasRole('colocation_manager')) {
            return null;
        }

        if ($user->isSubUser()) {
            if ($user->owner->hasRole('colocation_manager')) {
                return null;
            }
        }
        return false;
    }

    public function show(User $user, Rack $rack)
    {
        // the following checks are performed and if any one is true then the user is authorized to view the rack
        // 1. if the user is the owner of the rack then he can view it
        // 2. if the user->owner_id is the same as the rack->user_id then he can view it
        return $user->id === $rack->user_id ||
            $user->owner_id === $rack->user_id;
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('create') || $user->isUser();
    }

    public function update(User $user, Rack $rack)
    {
        // the following checks are performed and if any one is true then the user is authorized to edit the rack
        // 1. if the user is the owner of the rack then he can edit it
        // 2. if the user->owner_id is the same as the rack->user_id then he can edit it provided he has the permission 'update'
        return $user->id === $rack->user_id ||
            ($user->owner_id === $rack->user_id &&
                $user->hasPermissionTo('update'));
    }

    public function delete(User $user, Rack $rack)
    {
        // the following checks are performed and if any one is true then the user is authorized to delete the rack
        // 1. if the user is the owner of the rack then he can delete it
        // 2. if the user->owner_id is the same as the rack->user_id then he can delete it provided he has the permission 'delete'
        return $user->id === $rack->user_id ||
            ($user->owner_id === $rack->user_id &&
                $user->hasPermissionTo('delete'));
    }
}
