<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->id > 0 &&
            !$user->is_blocked
            ? Response::allow() : Response::deny('You are not permitted to perform this action');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return ($user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com") ||
            $user->id === $model->id
            ? Response::allow() : Response::deny('You are not permitted to view this resource');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com"
            ? Response::allow() : Response::deny('You are not permitted to perform this action');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return ($user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com") ||
            $user->id === $model->id
            ? Response::allow() : Response::deny('You are not permitted to view this resource');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com"
            ? Response::allow() : Response::deny('You are not permitted to perform this action');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        return $user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com"
            ? Response::allow() : Response::deny('You are not permitted to perform this action');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        return $user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com"
            ? Response::allow() : Response::deny('You are not permitted to perform this action');
    }

    /**
     * Determine whether the user can update any model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */

    public function updateAny(User $user)
    {
        return $user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com"
            ? Response::allow() : Response::deny('You are not permitted to perform this action');
    }


    /**
     * Determine whether the user can view acitivity logs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewLogs(User $user)
    {
        return $user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com"
            ? Response::allow() : Response::deny('You are not permitted to perform this action');
    }


    /**
     * Determine whether the user can block other users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function block(User $user)
    {
        return $user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com"
            ? Response::allow() : Response::deny('You are not permitted to perform this action');
    }
}
