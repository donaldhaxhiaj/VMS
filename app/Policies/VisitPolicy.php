<?php

namespace App\Policies;

use App\Model\admin\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the visit.
     *
     * @param  \App\Model\user\Admin  $user
     * @param  \App\visit  $visit
     * @return mixed
     */
    public function view(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can create visits.
     *
     * @param  \App\Model\user\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        return $this->getPermission($user,17);
    }


    /**
     * Determine whether the user can update the visit.
     *
     * @param  \App\Model\user\Admin  $user
     * @param  \App\visit  $visit
     * @return mixed
     */
    public function update(Admin $user)
    {
        return $this->getPermission($user,18);
    }

    /**
     * Determine whether the user can delete the visit.
     *
     * @param  \App\Model\user\Admin  $user
     * @param  \App\visit  $visit
     * @return mixed
     */
    public function delete(Admin $user)
    {
        return $this->getPermission($user,19);
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
