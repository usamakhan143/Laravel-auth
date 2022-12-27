<?php

namespace App\Policies;

use App\Models\backend\Account;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    public function settingLink(Account $user) {
        return $this->getPermissions($user, 'Setting-link');
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
