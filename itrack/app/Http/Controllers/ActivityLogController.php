<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Events\ActivityLogEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'canviewactivitylogs']);
    }

    public function index()
    {
        $title = 'itrack - Activity Logs';
        $logs = ActivityLog::latest()->simplePaginate(5);
        return view('logs.index', compact('title', 'logs'));
    }

    /**
     * Delete all activity logs.
     * @return \Illuminate\Http\Response
     */

    public function clearAllLogs(Request $request)
    {
        if ($request->clearing_agreement) {
            $user = User::findOrFail($request->user()->id);
            if ($user->isSuperAdmin()) {
                $activities = DB::table('activity_logs')->pluck('id');
                $logs_cleared = ActivityLog::destroy($activities);
                $description = "Cleared Activity Logs - Deleted all activity logs at " . Carbon::now();
                return $logs_cleared && event(new ActivityLogEvent(new ActivityLog, 'Clear Activity Logs', $description)) ?
                    redirect()->back()->with('success', 'Activity logs cleared successfully!') :
                    redirect()->back()->with('error', 'Actiion Failed. Something might be wrong!');
            }
        } else {
            return redirect()->back()->with('error', 'Unauthorized action spoted. Agreement must be made first');
        }
    }
}
