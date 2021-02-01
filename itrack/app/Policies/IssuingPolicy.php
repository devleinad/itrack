<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Issuing;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class IssuingPolicy
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
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com" ?
            Response::allow() : Response::deny('You are not permitted to view this resource');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Issuing  $issuing
     * @return mixed
     */
    public function view(User $user, Issuing $issuing)
    {
        return ($user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com") ||
            ($user->id === $issuing->user_id &&
                !$issuing->issuer->is_blocked) ?
            Response::allow() : Response::deny('You are not permitted to view this resource');
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
            !$user->is_blocked ?
            Response::allow() : Response::deny('You are not permitted to view this resource');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Issuing  $issuing
     * @return mixed
     */
    public function update(User $user, Issuing $issuing)
    {
        return ($user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com") ||
            ($user->id === $issuing->user_id &&
                !$issuing->issuer->is_blocked) ?
            Response::allow() : Response::deny('You are not permitted to view this resource');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Issuing  $issuing
     * @return mixed
     */
    public function delete(User $user, Issuing $issuing)
    {
        return ($user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com") ||
            ($user->id === $issuing->user_id &&
                !$issuing->issuer->is_blocked) ?
            Response::allow() : Response::deny('You are not permitted to view this resource');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Issuing  $issuing
     * @return mixed
     */
    public function restore(User $user, Issuing $issuing)
    {
        return ($user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com") ||
            ($user->id === $issuing->user_id &&
                !$issuing->issuer->is_blocked) ?
            Response::allow() : Response::deny('You are not permitted to view this resource');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return ($user->id > 0 &&
            !$user->is_blocked &&
            $user->email === "superadmin@admin.com") ?
            Response::allow() : Response::deny('You are not permitted to view this resource');
    }
}
