<?php

namespace App\Policies;

use App\User;
use App\Role;
use Log;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function hasRole(User $user, array $args)
    {
        $role = Role::where('name', $args[0])->first();
        // Log::info('Info833: ' . $user->role == $role);
        return $user->role == $role;
    }

   
}
