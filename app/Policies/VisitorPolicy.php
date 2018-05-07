<?php

namespace App\Policies;

use App\Model\admin\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the visitor.
     *
     * @param  \App\Model\user\User  $user
     * @param  \App\visitor  $visitor
     * @return mixed
     */
    public function view(admin $user)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Model\user\User  $user
     * @return mixed
     */
    public function create(admin $user)
    {
        return $this->getPermission($user,4);
    }

    /**
     * Determine whether the user can update the visitor.
     *
     * @param  \App\Model\user\User  $user
     * @param  \App\visitor  $visitor
     * @return mixed
     */
    public function update(admin $user)
    {
        return $this->getPermission($user,5);
    }

    /**
     * Determine whether the user can delete the visitor.
     *
     * @param  \App\Model\user\User  $user
     * @param  \App\visitor  $visitor
     * @return mixed
     */
    public function delete(admin $user)
    {
        return $this->getPermission($user,6);
    }
    public function tag(admin $user)
    {
        return $this->getPermission($user,11);
    }
    public function category(admin $user)
    {
        return $this->getPermission($user,12);
    }

    public function user(admin $user)
    {
        return $this->getPermission($user,7);
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
