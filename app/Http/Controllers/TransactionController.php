<?php

namespace App\Http\Controllers;

use App\Models\carts;
use App\Models\transaction;
use App\Models\transaction_items;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
    public function store(Request $request)
    {
        $userId = auth()->id(); // Assuming you have user authentication

        // Retrieve all cart items for the authenticated user
        $cartItems = carts::where('user_id', $userId)->get();

        // Check if there are items to order
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        // Create a new order
        $transaction = new transaction();
        $transaction->user_id = $userId;
        $transaction->total_amount = $cartItems->sum(function ($cartItem) {
            return $cartItem->items->price * $cartItem->quantity;
        });

        $transaction->status = 0;
        $transaction->save();

        // Create order items for each item in the cart
        foreach ($cartItems as $cartItem) {
            $transaction_items = new transaction_items();
            $transaction_items->transaction_id = $transaction->id;
            $transaction_items->item_id = $cartItem->item_id;
            $transaction_items->quantity = $cartItem->quantity;
            // $transaction_items->price = $cartItem->price;
            $transaction_items->save();
        }

        // Optionally, remove items from the cart after successful order
        carts::where('user_id', $userId)->delete();

        return redirect()->route('cart')->with('success', 'Order placed successfully!');
    }

    public function processOrder(Request $request)
    {
        $order = transaction::findOrFail($request->order_id);
        $order->status = 1; 
        $order->save();

        return redirect()->route('atransactions')->with('success', 'Order processed');
    }

    public function cancelOrder(Request $request)
    {
        $order = transaction::findOrFail($request->order_id);
        $order->status = 2;
        $order->save();

        return redirect()->route('atransactions')->with('error', 'Order cancelled');
    }

    public function showaTPage(Request $request)
    {
        $sortBy = $request->input('sortBy', 'id'); // Default to 'id'
        $order = $request->input('order', 'asc'); // Default order

        $orders = transaction::orderBy($sortBy, $order)->paginate(10)
        ->appends($request->except('page'));
        
        return view('admin.transaction', compact('orders', 'sortBy', 'order'));
    }

}
