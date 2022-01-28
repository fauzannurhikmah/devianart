<?php

namespace App\Policies;

use App\Models\{Art, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, $params)
    {
        return $user->id === $params->id;
    }
}
