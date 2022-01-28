<?php

namespace App\Policies;

use App\Models\{Art, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtworkPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Art $art)
    {
        return $user->id === $art->user_id;
    }
    public function delete(User $user, Art $art)
    {
        return $user->id === $art->user_id;
    }
}
