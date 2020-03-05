<?php

namespace App\Policies;

use App\Cohort;
use App\Membership;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CohortPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any cohorts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the cohort.
     *
     * @param  \App\User  $user
     * @param  \App\Cohort  $cohort
     * @return mixed
     */
    public function view(User $user, Cohort $cohort)
    {
        $admins = Membership::where('post', 'admin')->get();
        $permission = false;
        if (count($admins) > 0) {
            foreach ($admins as $key => $admin) {
                if($admin->user_id == $user->id) {
                    $permission = true;
                }
            }
        }
        return $permission;
    }

    /**
     * Determine whether the user can create cohorts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $admins = Membership::where('post', 'admin')->get();
        $permission = false;
        if (count($admins) > 0) {
            foreach ($admins as $key => $admin) {
                if($admin->user_id == $user->id) {
                    $permission = true;
                }
            }
        }
        return $permission;
    }

    /**
     * Determine whether the user can update the cohort.
     *
     * @param  \App\User  $user
     * @param  \App\Cohort  $cohort
     * @return mixed
     */
    public function update(User $user, Cohort $cohort)
    {
        $permission = false;
        foreach ($cohort->membership as $key => $leader) {
            if (($leader->post == 'chairperson' or $leader->post == 'secretary' or $leader->post == 'treasurer') and $leader->right == 'yes' and $user->id == $leader->user_id) {
                $permission = true;
            }elseif ($leader->post == 'admin') {
                $permission = true;
            }
        }
        return $permission;
    }

    /**
     * Determine whether the user can delete the cohort.
     *
     * @param  \App\User  $user
     * @param  \App\Cohort  $cohort
     * @return mixed
     */
    public function delete(User $user, Cohort $cohort)
    {
        $admins = Membership::where('post', 'admin')->get();
        $permission = false;
        if (count($admins) > 0) {
            foreach ($admins as $key => $admin) {
                if($admin->user_id == $user->id) {
                    $permission = true;
                }
            }
        }
        return $permission;
    }

    /**
     * Determine whether the user can restore the cohort.
     *
     * @param  \App\User  $user
     * @param  \App\Cohort  $cohort
     * @return mixed
     */
    public function restore(User $user, Cohort $cohort)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the cohort.
     *
     * @param  \App\User  $user
     * @param  \App\Cohort  $cohort
     * @return mixed
     */
    public function forceDelete(User $user, Cohort $cohort)
    {
        //
    }
}
