<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Customer $customer)
    {
        $customer->load(['carts.product']);

        $total = $customer->carts->sum(fn (Cart $cart) => $cart->quantity * $cart->product->price);

        return view('customers.cart', compact('customer', 'total'));
    }

    public function store(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock < 1) {
            return back()->with('error', "Product '{$product->name}' is out of stock.");
        }

        $cart = Cart::firstOrNew([
            'customer_id' => $customer->id,
            'product_id' => $product->id,
        ]);

        if ($cart->exists) {
            if ($cart->quantity + 1 > $product->stock) {
                return back()->with('error', "Only {$product->stock} unit(s) of '{$product->name}' available in stock.");
            }
            $cart->quantity += 1;
        } else {
            $cart->quantity = 1;
        }

        $cart->save();

        return back()->with('success', "'{$product->name}' added to {$customer->name}'s cart.");
    }

    public function update(Request $request, Customer $customer, Cart $cart)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = $cart->product;

        if ($validated['quantity'] > $product->stock) {
            return back()->with('error', "Only {$product->stock} unit(s) of '{$product->name}' available in stock.");
        }

        $cart->update(['quantity' => $validated['quantity']]);

        return back()->with('success', 'Cart updated successfully.');
    }

    public function destroy(Customer $customer, Cart $cart)
    {
        $cart->delete();

        return back()->with('success', 'Item removed from cart.');
    }
}
