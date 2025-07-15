<?php

namespace App\Observers;

use App\Models\Kid;

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
        logs()->debug("Kid {$kid->name} updated");
    }

    /**
     * Handle the Kid "deleted" event.
     */
    public function deleted(Kid $kid): void
    {
        //
    }

    /**
     * Handle the Kid "restored" event.
     */
    public function restored(Kid $kid): void
    {
        //
    }

    /**
     * Handle the Kid "force deleted" event.
     */
    public function forceDeleted(Kid $kid): void
    {
        //
    }
}
