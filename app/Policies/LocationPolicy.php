<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Location;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;

    private function for(User $user, $for)
    {
        // echo 'for check performed ' . $for . "\n";

        if ($for === 'colocation') {
            return $user->hasRole('colocation_manager');
        }

        if ($for === 'vps') {
            return $user->hasRole('vps_manager');
        }

        if ($for === 'server') {
            return $user->hasRole('dedicated_server_manager');
        }
    }

    public function before(User $user)
    {
        // if user is a subuser then get the owner of the user and check if the owner has the role 'colocation_manager'
        // if yes then return null so that the user can perform all the actions
        // else return false so that the user cannot perform any action

        if (
            $user->hasRole('colocation_manager') ||
            $user->hasRole('vps_manager')
        ) {
            return null;
        }

        if ($user->hasRole('admin')) {
            return true;
        }
        return false;
    }

    public function view(User $user, $for)
    {
        // the before method is called before this method
        // perform the for method to check if the user has the role 'colocation_manager' or 'vps_manager'
        if (!$this->for($user, $for)) {
            return false;
        }

        return true;
    }

    public function show(User $user, Location $location, $for)
    {
        // the following checks are performed and if any one is true then the user is authorized to view the rack
        // 1. if the user is the owner of the rack then he can view it
        // 2. if the user->owner_id is the same as the rack->user_id then he can view it
        if (!$this->for($user, $for)) {
            return false;
        }

        return $user->id === $location->user_id ||
            $user->owner_id === $location->user_id;
    }

    public function create(User $user, $for)
    {
        if (!$this->for($user, $for)) {
            return false;
        }

        return $user->hasPermissionTo('create') || $user->isUser();
    }

    public function update(User $user, Location $location, $for)
    {
        if (!$this->for($user, $for)) {
            return false;
        }

        // the following checks are performed and if any one is true then the user is authorized to edit the rack
        // 1. if the user is the owner of the rack then he can edit it
        // 2. if the user->owner_id is the same as the rack->user_id then he can edit it provided he has the permission 'update'
        return $user->id === $location->user_id ||
            ($user->owner_id === $location->user_id &&
                $user->hasPermissionTo('update'));
    }

    public function delete(User $user, Location $location, $for)
    {
        if (!$this->for($user, $for)) {
            return false;
        }
        // the following checks are performed and if any one is true then the user is authorized to delete the rack
        // 1. if the user is the owner of the rack then he can delete it
        // 2. if the user->owner_id is the same as the rack->user_id then he can delete it provided he has the permission 'delete'
        return $user->id === $location->user_id ||
            ($user->owner_id === $location->user_id &&
                $user->hasPermissionTo('delete'));
    }
}
