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
}