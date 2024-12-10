<?php

namespace App\Http\Controllers;

use App\Models\carts;
use App\Models\items;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function showHomePage()
    {
        $items = items::orderBy('created_at', 'desc')->take(4)->get();
        return view('main.homePage')->with('items', $items);
    }

    public function showShopPage()
    {
        $items = items::paginate(12);
        return view('main.shop')->with('items', $items);
    }

    public function showRegisterPage()
    {

        return view('auth.register');
    }

    public function showDetailPage(Request $request)
    {
        $item = items::find($request->id);
        return view('main.detail')->with('item', $item);
    }

    public function showHistoryPage(Request $request)
    {
        $userId = auth()->id();
        $item = transaction::where('user_id', $userId)->get();
        return view('main.history')->with('orders', $item);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $items = items::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate(12);

        return view('main.shop')->with('items', $items);
    }

    public function showaIPage(Request $request)
    {
        $sortBy = $request->input('sortBy', 'id'); // Default to 'id'
        $order = $request->input('order', 'asc'); // Default order

        $items = items::orderBy($sortBy, $order)->paginate(10)
        ->appends($request->except('page'));
        
        return view('admin.items', compact('items', 'sortBy', 'order'));
    }

    public function showProfilePage(Request $request)
    {
        
        $userId=auth()->id();
        $user=User::find($userId);
        
        
        return view('main.profile', compact('userId', 'user'));
    }

}
