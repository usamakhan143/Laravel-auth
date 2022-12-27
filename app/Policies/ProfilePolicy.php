<?php

namespace App\Policies;

use App\Models\backend\Account;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
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

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Account  $user
     * @param  \App\Models\backend\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Account $user)
    {
        return $this->getPermissions($user, 'Profile-view');
    }


    public function identityNumberView(Account $user) {

        return $this->getPermissions($user, 'Profile-identity');

    }

    public function idCard(Account $user) {
        return $this->getPermissions($user, 'Identity-card');
    }

    public function activateProfile(Account $user) {
        return $this->getPermissions($user, 'Activate-profile');
    }

    //Main Function for all the policies
    protected function getPermissions($modelName, $permission_name)
    {
        foreach ($modelName->roles as $role) 
        {
            foreach ($role->permission as $ijazat)
            {
                if ($ijazat->name == $permission_name)
                {
                    return true;
                }
            }
        }

        return false;
    }


}
