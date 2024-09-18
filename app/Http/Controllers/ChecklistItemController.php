<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChecklistItem;
use Illuminate\Support\Facades\Auth;

class ChecklistItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index($checklistId)
    {
        $items = ChecklistItem::where('checklist_id', $checklistId)->get();
        return response()->json($items);
    }


    public function store(Request $request, $checklistId)
    {
        $request->validate([
            'itemName' => 'required|string|max:255',
        ]);

        $item = new ChecklistItem();
        $item->checklist_id = $checklistId;
        $item->item_name = $request->input('itemName');
        $item->save();

        return response()->json($item, 201);
    }


    public function show($checklistId, $itemId)
    {
        $item = ChecklistItem::where('checklist_id', $checklistId)->where('id', $itemId)->firstOrFail();
        return response()->json($item);
    }


    public function updateStatus(Request $request, $checklistId, $itemId)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $item = ChecklistItem::where('checklist_id', $checklistId)->where('id', $itemId)->firstOrFail();
        $item->status = $request->input('status');
        $item->save();

        return response()->json($item);
    }


    public function destroy($checklistId, $itemId)
    {
        $item = ChecklistItem::where('checklist_id', $checklistId)->where('id', $itemId)->firstOrFail();
        $item->delete();

        return response()->json(null, 204);
    }

    public function rename(Request $request, $checklistId, $itemId)
    {
        $request->validate([
            'itemName' => 'required|string|max:255',
        ]);

        $item = ChecklistItem::where('checklist_id', $checklistId)->where('id', $itemId)->firstOrFail();
        $item->item_name = $request->input('itemName');
        $item->save();

        return response()->json($item);
    }
}
