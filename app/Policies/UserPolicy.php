<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */

    public function admin(User $user)
    {
        return $user->admin; 
    }

    public function auth(User $user)
    {
        return true; 
    }
}
