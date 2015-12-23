<?php

namespace App\Policies;

use App\Card;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User;

class CardPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	/**
     * Determin if the given user can delete the given card.
     * @param User $user
     * @param Card $card
     *
     * @return bool
     */
    public function destroy( User $user, Card $card )
    {
        return $user->id === $card->user_id;
    }
}
