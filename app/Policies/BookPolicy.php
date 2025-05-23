<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Book $book): bool
    {
        return $user->roles->pluck('name')->contains('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Book $book): bool
    {

        return ($user->seller && $user->seller->id === $book->seller_id)
        || $user->roles->pluck('name')->contains('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles->pluck('name')->contains('seller');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Book $book): bool
    {

        return $user->roles->pluck('name')->contains('seller') && ($user->seller && $user->seller->id === $book->seller_id);

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->roles->pluck('name')->contains('seller');
    }


    /**
     * Determine whether the user can toggle the model.
     */
    public function toggle(User $user): bool
    {
        return $user->roles->pluck('name')->contains('admin');
    }


    // specific for buyer :
    public function viewBuyer(User $user, Book $book): bool
    {
        return $book->status == true;
    }



}
