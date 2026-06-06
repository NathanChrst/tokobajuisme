<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCatalogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        $products = $query->latest()->paginate(12);
        $categories = Product::distinct()->pluck('category')->filter();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }
}
