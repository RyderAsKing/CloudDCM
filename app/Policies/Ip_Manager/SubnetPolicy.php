<?php

namespace App\Policies\Ip_Manager;

use App\Models\User;
use App\Models\Subnet;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubnetPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->hasRole('ip_manager')) {
            return null;
        }

        if ($user->hasRole('admin')) {
            return true;
        }
        return false;
    }

    public function view()
    {
        return true;
    }

    public function show(User $user, Subnet $subnet)
    {
        return $user->id === $subnet->user_id ||
            $user->owner_id === $subnet->user_id;
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('create') || $user->isUser();
    }

    public function update(User $user, Subnet $subnet)
    {
        return $user->id === $subnet->user_id ||
            ($user->owner_id === $subnet->user_id &&
                $user->hasPermissionTo('update'));
    }

    public function delete(User $user, Subnet $subnet)
    {
        return $user->id === $subnet->user_id ||
            ($user->owner_id === $subnet->user_id &&
                $user->hasPermissionTo('delete'));
    }
}
