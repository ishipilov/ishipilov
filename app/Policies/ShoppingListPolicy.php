<?php

namespace App\Policies;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingListPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ShoppingList $shoppingList)
    {
        return $shoppingList->user->is($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ShoppingList $shoppingList)
    {
        return $shoppingList->user->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ShoppingList $shoppingList)
    {
        return $shoppingList->user->is($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ShoppingList $shoppingList)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ShoppingList $shoppingList)
    {
        //
    }

    /**
     * Determine whether the user can toggle the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function toggle(User $user, ShoppingList $shoppingList)
    {
        return $shoppingList->user->is($user);
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function indata(User $user)
    {
        return $user;
    }
}
