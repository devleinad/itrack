<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\ActivityLog;
use App\Events\ActivityLogEvent;
use App\Http\Requests\customEditItemRequest;
use App\Http\Requests\customCreateItemRequest;

class ItemsController extends Controller
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
        $title = 'itrack - All Items';
        $items = Item::latest()->get();
        return view('items.index', compact('title', 'items'));
    }

    /**
     * Create a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'itrack - All Items';
        return view('items.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(customCreateItemRequest $request)
    {
        $item = Item::create(['item_name' => $request->item_name, 'unit' => $request->unit]);
        $description = "Created item - " . $item->item_name . " at " . Carbon::now();
        return $item &&  event(new ActivityLogEvent($item, 'Create Item', $description)) ? back()->with('success', 'Item created successfully!') : back()->with('error', 'Action failed. Please try again');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        $title = "itrack - View Item";
        return view('items.show', compact('item', 'title'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'itrack - Edit Item';
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(customEditItemRequest $request, $id)
    {
        $item = Item::findOrFail($id);

        $item_name = "";
        $unit = "";

        //lets get the old data, so that we would be able to detect changes made
        $oldItem_name = $item->item_name;
        $oldUnit = $item->unit;


        //We need to be sure we are not accepting duplicates
        if (
            Item::where('id', $item->id)->where('item_name', $request->item_name)->exists()
            || (Item::where('id', '!=', $item->id)->where('item_name', $request->item_name)->doesntExist())
        ) {
            if (!$request->filled('unit')) {
                $unit = $item->unit;
            } else {
                $unit = $request->unit;
            }

            $item->item_name = $request->item_name;

            if ($oldItem_name !== $item->item_name) {
                $item_name = $oldItem_name . " : Item name was changed from " . $oldItem_name . " to " . $item->item_name;
            } else {
                $item_name = $oldItem_name . " : Item name was not changed";
            }

            //Also, we need to log any changes that occur to the item's unit. If no changes ocurs to the unit we display something
            $item->unit = $unit;
            if ($item->unit !== $oldUnit) {
                $unit = ",unit " . $oldUnit . " to " . $item->unit;
            } else {
                $unit = ",unit did not change";
            }

            //Now we neet to construct a sentence from the logic created
            $description = "Updated item - " . $item_name . " " . $unit . " at " . Carbon::now();

            return $item->save() &&  event(new ActivityLogEvent($item, 'Update Item', $description)) ?  back()->with('success', 'Item updated successfully!') : back()->with('error', 'Action failed. Please try again');
        } else {
            return back()->with('error', 'Sorry, this item name is taken!');
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
        $item = Item::findOrFail($id);
        if ($item && $this->authorize($item)) {
            $description = "Deleted Item - " . $item->item_name . " at " . Carbon::now();
            return $item->delete() &&  event(new ActivityLogEvent($item, 'Delete Item', $description))  ? back()->with('success', 'Item deleted successfully!') : back()->with('error', 'Action failed. Please try again');
        }
    }
}
