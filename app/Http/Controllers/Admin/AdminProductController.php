<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'category', 'variants']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $products = $query->latest()->paginate(15)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        $categories = Category::whereNotNull('parent_id')->orderBy('name')->get();

        return view('admin.products.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'variants' => 'required|array|min:1',
            'variants.*.color' => 'required|string|max:50',
            'variants.*.size' => 'required|string|max:20',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.sku' => 'required|string|unique:product_variants,sku',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'base_price' => $request->base_price,
            'is_active' => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false),
        ]);

        // Create variants
        foreach ($request->variants as $variant) {
            $product->variants()->create($variant);
        }

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_url' => '/storage/' . $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $product->load(['variants', 'images']);
        $brands = Brand::orderBy('name')->get();
        $categories = Category::whereNotNull('parent_id')->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'brands', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'variants' => 'nullable|array',
            'variants.*.id' => 'nullable|exists:product_variants,id',
            'variants.*.color' => 'required|string|max:50',
            'variants.*.size' => 'required|string|max:20',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.sku' => 'required|string',
            'new_images' => 'nullable|array',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product->update([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'base_price' => $request->base_price,
            'is_active' => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false),
        ]);

        // Update/Create variants
        if ($request->has('variants')) {
            $existingIds = [];
            foreach ($request->variants as $variantData) {
                if (!empty($variantData['id'])) {
                    $variant = ProductVariant::find($variantData['id']);
                    if ($variant) {
                        $variant->update($variantData);
                        $existingIds[] = $variant->id;
                    }
                } else {
                    $newVariant = $product->variants()->create($variantData);
                    $existingIds[] = $newVariant->id;
                }
            }
            // Delete removed variants (only those not in any order)
            $product->variants()
                ->whereNotIn('id', $existingIds)
                ->whereDoesntHave('orderItems')
                ->delete();
        }

        // Upload new images
        if ($request->hasFile('new_images')) {
            $maxSort = $product->images()->max('sort_order') ?? 0;
            foreach ($request->file('new_images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_url' => '/storage/' . $path,
                    'sort_order' => $maxSort + $index + 1,
                ]);
            }
        }

        // Delete images
        if ($request->filled('delete_images')) {
            ProductImage::whereIn('id', $request->delete_images)->delete();
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->update(['is_active' => false]);
        $product->delete(); // soft delete

        return back()->with('success', 'Produk berhasil dinonaktifkan.');
    }
}

