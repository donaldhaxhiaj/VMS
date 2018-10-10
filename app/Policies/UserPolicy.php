<?php

namespace App\Policies;

use App\Model\admin\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Model\user\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(admin $user)
    {
        return $this->getPermission($user,21);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Model\user\admin  $user
     * @return mixed
     */
    public function create(admin $user)
    {
        return $this->getPermission($user,7);
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Model\user\admin  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(admin $user)
    {
        return $this->getPermission($user,8);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Model\user\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(admin $user)
    {
        return $this->getPermission($user,9);
    }
    public function role(admin $user)
    {
        return $this->getPermission($user,13);
    }
    public function permission(admin $user)
    {
        return $this->getPermission($user,15);
    }
    public function company(admin $user)
    {
        return $this->getPermission($user,16);
    }
    public function purpose(admin $user)
    {
        return $this->getPermission($user,20);
    }

    protected function getPermission($user,$p_id)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->id == $p_id) {
                    return true;
                }
            }
        }
        return false;
    }
}
