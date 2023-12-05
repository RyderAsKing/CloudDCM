<?php

namespace App\Policies\Customer_Relationship_Manager;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->has('customer_relationship_manager')) {
            return null;
        }

        if ($user->has('admin')) {
            return true;
        }
        return false;
    }

    public function view()
    {
        return true;
    }

    public function show(User $user, Customer $customer)
    {
        return $user->id === $customer->user_id ||
            $user->owner_id === $customer->user_id;
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('create') || $user->isUser();
    }

    public function update(User $user, Customer $customer)
    {
        return $user->id === $customer->user_id ||
            ($user->owner_id === $customer->user_id &&
                $user->hasPermissionTo('update'));
    }

    public function delete(User $user, Customer $customer)
    {
        return $user->id === $customer->user_id ||
            ($user->owner_id === $customer->user_id &&
                $user->hasPermissionTo('delete'));
    }
}
