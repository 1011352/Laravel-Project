<?php
namespace App\Policies;

use App\Models\Weapon;
use App\Models\User;

class Policies
{
    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Weapon  $post
     * @return bool
     */
    public function update(User $user, Weapon $weapon)
    {
        return $user->id === $weapon->user_id;
    }
}
