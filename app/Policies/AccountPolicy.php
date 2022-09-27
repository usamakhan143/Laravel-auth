<?php

namespace App\Policies;

use App\Models\backend\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Account  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Account  $user
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Account $account)
    {
        return $this->getPermissions($account, 'User-index');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Account  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Account $account)
    {
        return $this->getPermissions($account, 'User-create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Account  $user
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Account $account)
    {
        return $this->getPermissions($account, 'User-update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Account  $user
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Account $account)
    {
        return $this->getPermissions($account, 'User-destroy');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Account  $user
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Account $account)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Account  $user
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Account $account)
    {
        //
    }


    public function chgPassword(Account $admin)
    {
        return $this->getPermissions($admin, 'Change-password');
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
