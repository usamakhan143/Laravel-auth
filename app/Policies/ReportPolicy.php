<?php

namespace App\Policies;

use App\Models\backend\Account;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    public function reportLink(Account $user) {
        return $this->getPermissions($user, 'Report-link');
    }

    public function generate(Account $user) {
        return $this->getPermissions($user, 'Report-generate');
    }

    public function allThisMonthAttendance(Account $user) {
        return $this->getPermissions($user, 'All-this-month-attendance');
    }
    
    public function userSinglePageAttendance(Account $user) {
        return $this->getPermissions($user, 'User-single-page-attendance');
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
