<?php

namespace App\Http\Controllers;


use App\Models\carts;
use Auth;
use Illuminate\Http\Request;
use Schema;

class CartController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $itemId = $request->input('item_id');
            $quantity = $request->input('quantity', 1); // default to 1 if not provided

            $cartItem = carts::where('user_id', $userId)
                ->where('item_id', $itemId)
                ->where('status', 0)
                ->first();

            // Insert data into the carts table
            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
                session()->flash('success', 'Item added to cart successfully!');
                return redirect()->back()->with('success', 'Item added to cart successfully.');
            } else {
                carts::create([
                    'user_id' => $userId,
                    'item_id' => $itemId,
                    'quantity' => $quantity,
                    'status' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            session()->flash('success', 'Item added to cart successfully!');
            return redirect()->back()->with('success', 'Item added to cart successfully.');
        } else {
            return redirect()->route('login');
        }
    }

    public function showCartPage()
    {

        $userId = auth()->id();
        $carts = carts::where('user_id', $userId)->get();

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->quantity * $cart->items->price;
        });

        return view('main.cart', compact('carts','totalPrice'));
    }

    public function showaCartPage()
    {

        $carts = carts::all();
   

        return view('admin.cart', compact('carts'));
    }

    public function updateCartQuantity(Request $request)
    {
        $cart = carts::find($request->cart_id);

        if ($cart) {
            if ($request->action === 'increment') {
                $cart->quantity += 1;
                $cart->save();
            } 
            elseif ($request->action === 'decrement' && $cart->quantity > 1) {
                $cart->quantity -= 1;
                $cart->save();
            }
            elseif ($request->action === 'decrement' && $cart->quantity === 1) {
                $cart->delete();
            }

            
        }
        // $totalPrice=$cart->quantity * $cart->items->price;
        return redirect()->route('cart')->with('success', 'Quantity updated successfully!')
            // ->with('totalPrice', $totalPrice)
        ;
    }


    // public function showTable()
    // {

    //     $columns = Schema::getColumnListing('carts');
    //     $data = carts::all();

    //     return view('main.cart', compact('columns', 'data'));
    // }
}
