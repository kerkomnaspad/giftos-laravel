<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    //edit blm jadi
    //next profile page

    public function showaUPage(Request $request)
    {
        $sortBy = $request->input('sortBy', 'id'); // Default to 'id'
        $order = $request->input('order', 'asc'); // Default order

        $lastUser = User::orderBy('id', 'desc')->first();
        $nextId = $lastUser ? $lastUser->id + 1 : 1;

        $users = User::orderBy($sortBy, $order)->paginate(10)
            ->appends($request->except('page'));

        return view('admin.users', compact('users', 'sortBy', 'order', 'nextId'));
    }

    // public function toggleAddItemForm()
    // {
    //     if (session('showAddItemForm')) {
    //         session()->forget('showAddItemForm');
    //     } else {
    //         session()->put('showAddItemForm', true);
    //     }

    //     return redirect()->route('aitems'); // Redirect back to the items page
    // }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'type_id' => 'required|exists:itemtypes,id',
    //         'name' => 'required|string|max:255',
    //         'price' => 'required|numeric',
    //         'quantity' => 'required|integer',
    //         'description' => 'required|string',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     if ($validator->fails()) {
    //         // Redirect back with error message if validation fails
    //         return redirect()->route('aitems')->with('error', 'Failed to add item. Please check your input.');
    //     }

    //     $validated = $validator->validated();
    //     $item = new User($validated);
    //     if ($request->hasFile('image')) {
    //         $path = $request->file('image')->store('images/items', 'public');
    //         $item->image = $path;
    //     }

    //     if ($item->save()) {
    //         return redirect()->route('aitems')->with('success', 'Item added successfully!');
    //     } else {
    //         return redirect()->route('aitems')->with('error', 'Failed to add item.');
    //     }
    // }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return redirect()->route('ausers')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('ausers')->with('error', 'Failed to delete user.');
        }
    }

    public function toggleEditUserForm(Request $request, $id)
    {
        $item = User::findOrFail($id);
        session()->put('editUserForm', $item);
        $page = $request->input('page', 1);
        session(['editUserForm' => $id, 'currentPage' => $page]);
        return redirect()->route('ausers', ['page' => $page]); // Redirect back to the items page
    }

    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255'
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);
        session()->forget('editUserForm');
        $page = $request->input('page', 1);
        return redirect()->route('ausers', ['page' => $page])->with('success', 'User updated successfully!');
    }

    public function cancelEditUserForm()
    {
        session()->forget('editUserForm');
        return redirect()->route('ausers')->with('info', 'Edit cancelled.');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(), // Exclude current user
            'password' => 'nullable|string|confirmed|min:8', // Only validate if provided
        ]);

        try {
            $user = auth()->user(); // Fetch the authenticated user

            // Update user fields
            $user->name = $validated['name'];
            $user->email = $validated['email'];

            // Update the image if provided
            if ($request->hasFile('image')) {
                $user->image = $request->file('image')->store('images', 'public');
            }

            // Update the password if provided
            if (!empty($validated['password'])) {
                $user->password = bcrypt($validated['password']);
            }

            $user->save();

            // Success response
            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            // Error response
            return redirect()->back()->with('error', 'Failed to update profile. Please try again.');
        }
    }


}
