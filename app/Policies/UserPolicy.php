<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function list(User $user)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        if ($user->hasRole('user')) {
            return true;
        }

        return false;
    }

    public function view(User $user, User $model)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        if ($user->hasRole('user')) {
            if ($user->id === $model->owner_id) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    public function create(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('user');
    }

    public function update(User $user, User $model)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        if ($user->hasRole('user')) {
            if ($user->id === $model->owner_id) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function impersonate(User $user)
    {
        return $user->hasRole('admin');
    }

    public function search(User $user)
    {
        return $user->hasRole('admin');
    }
}
