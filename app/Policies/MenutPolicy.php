<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Menut;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenutPolicy
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

    function create(User $user) {
        return $this->update($user);
    }
    
    function update(User $user) {
        return $user->isAdministrator();
    }

    function delete(User $user, Menut $menut) {
        $menut->loadCount('maindishes');
        return $this->update($user) && ($menut->maindishes_count === 0);
    }
}
