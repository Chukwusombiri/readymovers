<?php

namespace App\Listeners;

use App\Models\Admin;
use Illuminate\Auth\Events\Logout as EventsLogout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogoutOfflineListener implements ShouldQueue
{
    Use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Logout  $event
     * @return void
     */
    public function handle(EventsLogout $event)
    {
        $admin = Admin::findOrFail($event->user->id);
        $admin->isOnline = false;
        $admin->save();
    }
}
