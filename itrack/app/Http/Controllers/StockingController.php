<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Stock;
use App\Events\ActivityLogEvent;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\customEditStockRequest;
use App\Http\Requests\customCreateStockRequest;

class StockingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "itrack - All Stocks";
        $stocks = Stock::latest()->with('item')->get();
        return view('stocks.index', compact('title', 'stocks'));
    }



    /**
     * Create a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "itrack - Create Stocks";
        $items = Item::orderBy('item_name', 'ASC')->get();
        return view('stocks.create', compact('title', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(customCreateStockRequest $request)
    {
        $stock = Stock::create([
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'from' => $request->from,
            'report' => $request->report,
        ]);
        $description = "Stocked Item - " . $stock->item->item_name . " with " . $stock->quantity . " " . $stock->item->unit . " at " . Carbon::now();
        return $stock  &&  event(new ActivityLogEvent($stock, 'Stock Item', $description)) ? back()->with('success', 'Item created successfully!') : back()->with('error', 'Action failed. Please try again');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        $title = "itrack - View Stock";
        return view('stocks.show', compact('title', 'stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stock::with('item')->findOrFail($id);
        $items = Item::orderBy('item_name', 'ASC')->get();
        $title = 'itrack - Edit Stocks';
        return view('stocks.edit', compact('title', 'stock', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(customEditStockRequest $request, $id)
    {
        if ($stock = Stock::findOrFail($id)) {
            $oldFrom = $stock->from;
            $oldQuantity = $stock->quantity;
            $oldReport = $stock->report;

            $from = "";
            $quantity = "";
            $report = "";

            $stock->from = $request->from;
            $stock->quantity = $request->quantity;
            $stock->report = $request->report;

            if ($oldFrom !== $stock->from) {
                $from = "Changed source of items from " . $oldFrom . " to " . $stock->from;
            } else {
                $from = "Source of items is still " . $oldFrom;
            }

            if ($oldQuantity !== $stock->quantity) {
                $quantity = ",quantity was changed from " . $oldQuantity . " to " . $stock->quantity;
            } else {
                $quantity = ",quantity was not changed";
            }

            if ($oldReport !== $stock->report) {
                $report = ",and report updated from to " . $stock->report;
            } else {
                $report = ",also report was not changed";
            }
            $description = "Updated Stock - " . $from . "  " . $quantity . " " . $report . " at " . Carbon::now();
            return $stock->save() &&  event(new ActivityLogEvent($stock, 'Update Stock', $description)) ?  back()->with('success', 'Stock updated successfully!') : back()->with('error', 'Action failed. Please try again');
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
        $stock = Stock::findOrFail($id);
        $description = "Deleted Stock - " . $stock->item->item_name . " at " . Carbon::now();
        return $stock->delete() && event(new ActivityLogEvent($stock, 'Delete Stock', $description)) ? back()->with('success', 'Stock deleted successfully!') : back()->with('error', 'Action failed. Please try again');
    }
}
