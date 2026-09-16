<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'images', 'variants'])
            ->where('is_active', true);

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->filled('category')) {
            $category = Category::find($request->category);
            if ($category) {
                $categoryIds = $category->children()->pluck('id')->push($category->id);
                $query->whereIn('category_id', $categoryIds);
            }
        }

        // Brand filter
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // Price range
        if ($request->filled('min_price')) {
            $query->where('base_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('base_price', '<=', $request->max_price);
        }

        // Size filter
        if ($request->filled('size')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('size', $request->size)->where('stock', '>', 0);
            });
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        $query = match ($sort) {
            'price_asc' => $query->orderBy('base_price', 'asc'),
            'price_desc' => $query->orderBy('base_price', 'desc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            default => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::whereNull('parent_id')->with('children')->get();
        $brands = Brand::orderBy('name')->get();

        // Collect all unique sizes for filter
        $sizes = \App\Models\ProductVariant::distinct()->pluck('size')->sort()->values();

        return view('products.index', compact('products', 'categories', 'brands', 'sizes'));
    }

    public function show(Product $product)
    {
        $product->load(['brand', 'category.parent', 'images', 'variants']);

        $relatedProducts = Product::with(['brand', 'images'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        $isWishlisted = false;
        if (auth()->check()) {
            $isWishlisted = auth()->user()->wishlists()->where('product_id', $product->id)->exists();
        }

        return view('products.show', compact('product', 'relatedProducts', 'isWishlisted'));
    }
}

