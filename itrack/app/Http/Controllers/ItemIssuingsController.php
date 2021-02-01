<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Issuing;
use Illuminate\Http\Request;
use App\Events\ActivityLogEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Listeners\ActivityLogListener;
use App\Http\Requests\customIssueItemRequest;

class ItemIssuingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'itrack - Issuings';
        $issuings = Issuing::latest()->with(['item'])->get();
        return view('issuings.index', compact('issuings', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "itrack - Issue Items";
        $items = Item::orderBy('item_name', 'ASC')->get();
        return view('issuings.create', compact('title', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(customIssueItemRequest $request)
    {
        $item = Item::findOrFail($request->item_id);
        if ($item->getTotalQuantity() < $request->quantity) {
            return back()->with('error', 'Sorry, you cannot issue more than you already have!');
        } else {
            $issued = Issuing::create([
                'user_id' => Auth::id(),
                'item_id' => $item->id,
                'quantity' => $request->quantity,
                'receiver' => $request->receiver,
                'report' => $request->report,
            ]);
            $description = "Issued Item - Issued " . $issued->quantity . " " . $issued->item->unit . " of " . $issued->item->item_name . " to " . $issued->receiver . " at " . Carbon::now();

            return $issued && event(new ActivityLogEvent($issued, 'Issue Item', $description)) ? back()->with('success', 'Item issued successfully!') : back()->with('error', 'Action failed. Please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'itrack - View Issued';
        $issuing = Issuing::findOrFail($id);
        return view('issuings.show', compact('title', 'issuing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'itrack - View Issued';
        $issue = Issuing::findOrFail($id);
        return view('issuings.edit', compact('title', 'issue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(customIssueItemRequest $request, $id)
    {

        $issued = Issuing::findOrFail($id);


        $item = Item::findOrFail($issued->item_id);
        if ($item->getTotalQuantity() < $request->quantity) {
            return back()->with('error', 'Sorry, you cannot issued more than you already have!');
        } else {

            $quantity = "";
            $receiver = "";
            $report = "";

            $oldIssuedQunatity = $issued->quantity;
            $oldIssuedReceiver = $issued->receiver;
            $oldIssuedReport = $issued->report;

            $issued->quantity = $request->quantity;
            $issued->receiver = $request->receiver;
            $issued->report = $request->report;



            if ($oldIssuedQunatity !== $issued->quantity) {
                $quantity = "Quantity changed from " . $oldIssuedQunatity . " to " . $issued->quantity;
            } else {
                $quantity = "Quantity remain unchanged - " . $oldIssuedQunatity . " " . $issued->item->unit;
            }

            if ($oldIssuedReceiver !== $issued->receiver) {
                $receiver = ", Receiver changed from " . $oldIssuedReceiver . " to " . $issued->receiver;
            } else {
                $receiver = ", Receiver was not changed";
            }

            if ($oldIssuedReport !== $issued->report) {
                $report = ", and Report chnaged from " . $oldIssuedReport . " to " . $issued->report;
            } else {
                $report = ", and Report was also not changed";
            }

            $description = "Updated Issued Item - " . $quantity . " " . $receiver . " " . $report . " at " . Carbon::now();
            return $issued->save() &&  event(new ActivityLogEvent($issued, 'Update Issued Item', $description)) ? back()->with('success', 'Item issued updated successfully!') : back()->with('error', 'Action failed. Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $issued = Issuing::findOrFail($id);
        $description = "Deleted Issued Item - " . $issued->item->item_name . " at " . Carbon::now();
        return $issued->delete() && event(new ActivityLogEvent($issued, 'Delete Stock', $description)) ? back()->with('success', 'Issue deleted updated successfully!') : back()->with('error', 'Action failed. Please try again');
    }
}
