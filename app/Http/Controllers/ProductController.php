<?php

namespace App\Http\Controllers;
use App\Models\products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = products::all();
        return view('products.index',['products' => $products]);

    }

    public function create()
    {
        return view('products.create');
    }
    public function edit(products $product)
    {   
        return view('products.edit', ['product' => $product]);
    }
    public function update(Request $request, products $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
            'description' => 'nullable|string',
        ]);
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
            'description' => 'nullable|string',
        ]);
        $NewProduct = products::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    public function destroy(products $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
