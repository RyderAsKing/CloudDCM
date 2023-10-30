<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function list(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('user');
    }

    public function create(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('user');
    }

    public function update(User $user, User $model)
    {
        return $user->hasRole('admin') ||
            ($user->hasRole('user') && $user->id === $model->owner_id);
    }

    public function delete(User $user, User $model)
    {
        return $user->hasRole('admin') ||
            ($user->hasRole('user') && $user->id === $model->owner_id);
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
