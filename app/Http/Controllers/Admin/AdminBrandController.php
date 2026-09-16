<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')->orderBy('name')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1024',
        ]);

        $logoUrl = null;
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('brands', 'public');
            $logoUrl = '/storage/' . $path;
        }

        Brand::create([
            'name' => $request->name,
            'logo_url' => $logoUrl ?? 'https://ui-avatars.com/api/?name=' . urlencode($request->name) . '&background=random&size=128',
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand berhasil ditambahkan.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1024',
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('brands', 'public');
            $data['logo_url'] = '/storage/' . $path;
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('success', 'Brand berhasil diperbarui.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete(); // soft delete
        return back()->with('success', 'Brand berhasil dihapus.');
    }
}

