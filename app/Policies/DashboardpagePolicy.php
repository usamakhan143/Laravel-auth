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
