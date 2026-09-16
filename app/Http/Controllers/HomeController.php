<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['brand', 'images', 'variants'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $newProducts = Product::with(['brand', 'images', 'variants'])
            ->where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::whereNull('parent_id')
            ->with('children')
            ->get();

        $brands = Brand::all();

        return view('home', compact('featuredProducts', 'newProducts', 'categories', 'brands'));
    }
}

