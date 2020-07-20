<?php

namespace App\Policies;

use App\Model\admin\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Model\user\User  $user
     * @param  \App\Post  $post
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
     * Determine whether the user can update the post.
     *
     * @param  \App\Model\user\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(admin $user)
    {
        return $this->getPermission($user,5);
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Model\user\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */

     public function publish(admin $user)
    {
        return $this->getPermission($user,7);
    }

    public function delete(admin $user)
    {
        return $this->getPermission($user,6);
    }

    public function category(admin $user)
    {
        return $this->getPermission($user,8);
    }

    public function tag(admin $user)
    {
        return $this->getPermission($user,9);
    }

    public function addAdminUser(admin $user)
    {
        return $this->getPermission($user,1);
    }

    public function updateAdminUser(admin $user)
    {
        return $this->getPermission($user,2);
    }

    public function deleteAdminUser(admin $user)
    {
        return $this->getPermission($user,3);
    }

    //For Roles Policy
    public function role(admin $user)
    {
        return $this->getPermission($user,10);
    }

    //Permission Policy
    public function permission(admin $user)
    {
        return $this->getPermission($user,11);
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
