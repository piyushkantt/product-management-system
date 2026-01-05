<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index()
{
    $products = Product::latest()->paginate(10);
    return view('admin.products.index', compact('products'));
}
public function show()
{
    
    $products = Product::latest()->paginate(10);
    return view('customer.dashboard', compact('products'));
}

public function create()
{
    return view('admin.products.create');
}
public function store(Request $request)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'category'    => 'required|string|max:100',
        'stock'       => 'required|integer|min:0',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    } else {
        $validated['image'] = 'default.png';
    }

    Product::create($validated);

    return redirect()->route('admin.products.index')
        ->with('success', 'Product created successfully');
}
public function edit(Product $product)
{
    return view('admin.products.edit', compact('product'));
}
public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'category'    => 'required|string|max:100',
        'stock'       => 'required|integer|min:0',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($validated);

    return redirect()->route('admin.products.index')
        ->with('success', 'Product updated successfully');
}

public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('admin.products.index')
        ->with('success', 'Product deleted successfully');
}
}
