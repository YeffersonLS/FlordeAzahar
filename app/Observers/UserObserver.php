<?php

namespace App\Observers;

use App\Models\T13carrito;
use App\Models\User;

class UserObserver
{

    public function creating(User $user): void
    {

    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $cartCache = request()->cookie('flordeazahar_session');

        $query = T13carrito::where('t13sessionid', $cartCache)->first();
        if (empty($query)) {
            $query->t13sessionid = null;
            $query->t13cliente = $user->sys01id;
            // $query->save();
            dd($query);
        }
        dd($user, $query);



    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {

    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
