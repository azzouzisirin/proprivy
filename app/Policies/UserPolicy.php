<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OtherModel;  
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    public function manageUsers(User $user)
    {
        return $user->role === 'owner'; // Seulement un 'owner' peut gérer les utilisateurs
    }

}
