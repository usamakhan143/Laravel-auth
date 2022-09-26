<?php

namespace App\Policies;

use App\Models\backend\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    // use HandlesAuthorization;

    // /**
    //  * Determine whether the user can view any models.
    //  *
    //  * @param  \App\Models\backend\Account  $user
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function viewAny(User $user)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  *
    //  * @param  \App\Models\backend\Account  $user
    //  * @param  \App\Models\backend\Role  $role
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function view(User $user, Role $role)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can create models.
    //  *
    //  * @param  \App\Models\backend\Account  $user
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function create(User $user)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can update the model.
    //  *
    //  * @param  \App\Models\backend\Account  $user
    //  * @param  \App\Models\backend\Role  $role
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function update(User $user, Role $role)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can delete the model.
    //  *
    //  * @param  \App\Models\backend\Account  $user
    //  * @param  \App\Models\backend\Role  $role
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function delete(User $user, Role $role)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can restore the model.
    //  *
    //  * @param  \App\Models\backend\Account  $user
    //  * @param  \App\Models\backend\Role  $role
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function restore(User $user, Role $role)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  *
    //  * @param  \App\Models\backend\Account  $user
    //  * @param  \App\Models\backend\Role  $role
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function forceDelete(User $user, Role $role)
    // {
    //     //
    // }



    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\backend\Account  $user
     * @return mixed
     */
    public function viewAny(Account $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\backend\Account  $user
     * @param  \App\Models\admin\role  $role
     * @return mixed
     */
    public function view(Account $user)
    {
        return $this->getPermissions($user, 'Role-index');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\backend\Account  $user
     * @return mixed
     */
    public function create(Account $user)
    {
        return $this->getPermissions($user, 'Role-create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\backend\Account  $user
     * @param  \App\Models\admin\role  $role
     * @return mixed
     */
    public function update(Account $user)
    {
        return $this->getPermissions($user, 'Role-update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\backend\Account  $user
     * @param  \App\Models\admin\role  $role
     * @return mixed
     */
    public function delete(Account $user)
    {
        return $this->getPermissions($user, 'Role-destroy');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\backend\Account  $user
     * @param  \App\Models\admin\role  $role
     * @return mixed
     */
    public function restore(Account $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\backend\Account  $user
     * @param  \App\Models\admin\role  $role
     * @return mixed
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
