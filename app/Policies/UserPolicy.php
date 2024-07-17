<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewUsers(User $user)
{
    return $user->role === 1; // Autorise seulement les administrateurs (role == 1)
}

public function viewProjects(User $user)
{
    return $user->role === 0; // Autorise seulement les utilisateurs (role == 0)
}

}
