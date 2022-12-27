<?php

namespace App\Policies;

use App\Models\backend\Account;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HolidayPolicy
{
    use HandlesAuthorization;

    public function holidayIndex(Account $user) {
        return $this->getPermissions($user, 'Holiday-view');
    }

    public function holidayCreate(Account $user) {
        return $this->getPermissions($user, 'Holiday-create');
    }

    public function holidayEdit(Account $user) {
        return $this->getPermissions($user, 'Holiday-edit');
    }
    
    public function holidayDelete(Account $user) {
        return $this->getPermissions($user, 'Holiday-delete');
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
