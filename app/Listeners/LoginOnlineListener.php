<?php

namespace App\Listeners;

use App\Models\Admin;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginOnlineListener implements ShouldQueue
{
    use InteractsWithQueue;
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
     * @param  object  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        $admin = Admin::findOrFail($event->user->id);
        $admin->isOnline = true;
        $admin->save();
    }
}
