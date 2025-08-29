<?php

namespace App\Observers;

use App\Models\Kid;
use App\Notifications\NotifyKidUpdated;

class KidObserver
{
    /**
     * Handle the Kid "created" event.
     */
    public function created(Kid $kid): void
    {
        logs()->debug("Kid {$kid->id} created");
    }

    /**
     * Handle the Kid "updated" event.
     */
    public function updated(Kid $kid): void
    {
        logs()->debug("Kid {$kid->id} - {$kid->name} updated");

        $users = $kid->users()
            ->where('kid_id', $kid->id)
            ->get();

        if ($users->count() > 0) {
            foreach ($users as $user) {
                $user->notify(new NotifyKidUpdated($user));
            }
        }
    }
}
