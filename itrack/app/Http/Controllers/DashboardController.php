<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Stock;
use App\Models\Issuing;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "itrack - Dashboard";
        $activity_logs = ActivityLog::latest()->get();
        $users_count = User::count();
        $items_count = Item::count();
        $issuings_count = Issuing::count();
        $stocks_count = Stock::count();
        return view('dashboard', compact('title', 'activity_logs', 'users_count', 'items_count', 'issuings_count', 'stocks_count'));
    }
}
