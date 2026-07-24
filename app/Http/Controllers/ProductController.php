<?php

namespace App\Http\Controllers;

use App\Http\Requests\{ProductStoreRequest, ProductUpdateRequest};
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        Product::create($request->validated());

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product moved to trash.');
    }

    public function trashed(): View
    {
        $products = Product::onlyTrashed()->latest('deleted_at')->paginate(10);

        return view('products.trashed', compact('products'));
    }

    public function restore(Product $product): RedirectResponse
    {
        $product->restore();

        return redirect()->route('products.index')->with('success', 'Product restored successfully.');
    }

    public function forceDelete(Product $product): RedirectResponse
    {
        $product->forceDelete();

        return redirect()->route('products.trashed')->with('success', 'Product permanently deleted.');
    }
}
