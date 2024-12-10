<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Models\itemtypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    //
    public function showaIPage(Request $request)
    {
        $sortBy = $request->input('sortBy', 'id'); // Default to 'id'
        $order = $request->input('order', 'asc'); // Default order

        $lastItem = items::orderBy('id', 'desc')->first();
        $nextId = $lastItem ? $lastItem->id + 1 : 1;
        $itemTypes = itemtypes::all();
        $items = items::orderBy($sortBy, $order)->paginate(10)
            ->appends($request->except('page'));

        return view('admin.items', compact('items', 'sortBy', 'order', 'nextId', 'itemTypes'));
    }

    public function toggleAddItemForm()
    {
        if (session('showAddItemForm')) {
            session()->forget('showAddItemForm');
        } else {
            session()->put('showAddItemForm', true);
        }

        return redirect()->route('aitems'); // Redirect back to the items page
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_id' => 'required|exists:itemtypes,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'required|string',
            // 'image' => 'nullable|file',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',

        ]);

        if ($validator->fails()) {
            // Redirect back with error message if validation fails
            return redirect()->route('aitems')->with('error', 'Failed to add item. Please check your input.');
        }

        $validated = $validator->validated();
        $item = new items($validated);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/items', 'public');
            $item->image = $path;
        }

        if ($item->save()) {
            return redirect()->route('aitems')->with('success', 'Item added successfully!');
        } else {
            return redirect()->route('aitems')->with('error', 'Failed to add item.');
        }
    }

    public function destroy(Request $request,$id)
    {
        $item = items::findOrFail($id);
        $page = $request->input('page', 1);
        if ($item->delete()) {
            return redirect()->route('aitems',['page'=>$page])->with('success', 'Item deleted successfully.');
        } else {
            return redirect()->route('aitems',['page'=>$page])->with('error', 'Failed to delete item.');
        }
    }

    public function toggleEditItemForm(Request $request, $id)
    {
        $item = items::findOrFail($id);
        session()->put('editItemForm', $item);
        $page = $request->input('page', 1);
        session(['editItemForm' => $id, 'currentPage' => $page]);
        return redirect()->route('aitems', ['page' => $page]); // Redirect back to the items page
    }

    public function updateItem(Request $request, $id)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:itemtypes,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $item = items::findOrFail($id);
        $item->update($validated);
        session()->forget('editItemForm');
        $page = $request->input('page', 1);
        return redirect()->route('aitems',['page'=>$page])->with('success', 'Item updated successfully!');
    }

    public function cancelEditItemForm(Request $request)
    {
        session()->forget('editItemForm');
        $page = $request->input('page', 1);
        return redirect()->route('aitems',['page'=>$page])->with('info', 'Edit cancelled.');
    }

}
