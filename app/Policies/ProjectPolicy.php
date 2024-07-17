<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class ProjectPolicy
{
    public function viewAny(User $user)
    {
        return true; // Permet de voir la liste des projets
    }

    public function view(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }

    public function create(User $user)
    {
        return true; // Tous les utilisateurs peuvent créer des projets
    }

    public function update(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }

    public function delete(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }
}

