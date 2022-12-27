<?php

namespace App\Policies;

use App\Models\backend\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardpagePolicy
{
    use HandlesAuthorization;

    // Employees
    public function viewEmp(Account $user) {

        return $this->getPermissions($user, 'Total-employees');
    
    }

    // Present Employee
    public function viewAttendance(Account $user) {

        return $this->getPermissions($user, 'Employee-attendance-admin-view');
    
    }

    public function viewPendingProf(Account $user) {
        return $this->getPermissions($user, 'Pending-profiles-admin-view');
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
