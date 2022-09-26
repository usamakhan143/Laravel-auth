<?php

namespace App\Policies;

use App\Models\backend\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Account  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Account $user)
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
        return $this->getPermissions($user, 'Permission-index');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Account  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Account $user)
    {
        return $this->getPermissions($user, 'Permission-create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Account  $user
     * @param  \App\Models\backend\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Account $user)
    {
        return $this->getPermissions($user, 'Permission-update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Account  $user
     * @param  \App\Models\backend\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Account $user)
    {
        return $this->getPermissions($user, 'Permission-destroy');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Account  $user
     * @param  \App\Models\backend\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Account $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Account  $user
     * @param  \App\Models\backend\Permission  $permission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Account $user)
    {
        //
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
