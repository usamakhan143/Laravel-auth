<?php

namespace App\Policies;

use App\Models\backend\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class NetworkPolicy
{
    use HandlesAuthorization;

    public function viewAll(Account $user) {
        return $this->getPermissions($user, 'Network-index');
    }

    public function create(Account $user) {
        return $this->getPermissions($user, 'Network-create');
    }

    public function update(Account $user) {
        return $this->getPermissions($user, 'Network-update');
    }
    
    public function delete(Account $user) {
        return $this->getPermissions($user, 'Network-delete');
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
