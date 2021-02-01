<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivityLogListener
{
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
    public function handle(ActivityLogEvent $event)
    {
        //log to database table
        ActivityLog::create([
            'activity' => $event->activity,
            'user_id' => Auth::id(),
            'model' => get_class($event->model),
            'description' => $event->description,

        ]);

        //log to a file
        $activity = "\n" . $event->activity . " --- " . $event->description . " ---by :" . Auth::user()->name;
        ActivityLog::logActivity($activity);
    }
}
