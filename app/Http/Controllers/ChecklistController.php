<?php
namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChecklistController extends Controller
{

    public function index()
    {
        $checklists = Checklist::all();
        return response()->json($checklists);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $checklist = Checklist::create($request->all());
        return response()->json($checklist, 201);
    }


    public function destroy($id)
    {
        $checklist = Checklist::find($id);

        if (!$checklist) {
            return response()->json(['message' => 'Checklist not found'], 404);
        }

        $checklist->delete();
        return response()->json(['message' => 'Checklist deleted successfully'], 200);
    }
}
