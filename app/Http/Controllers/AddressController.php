<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = auth()->user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:50',
            'street' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);

        $address = auth()->user()->addresses()->create($request->only([
            'label', 'street', 'city', 'province', 'postal_code',
        ]));

        // If first address, set as default
        if (auth()->user()->addresses()->count() === 1) {
            $address->update(['is_default' => true]);
        }

        return redirect()->route('addresses.index')->with('success', 'Alamat berhasil ditambahkan.');
    }

    public function edit(Address $address)
    {
        $this->authorize('update', $address);
        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        $this->authorize('update', $address);

        $request->validate([
            'label' => 'required|string|max:50',
            'street' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'is_default' => 'sometimes|boolean',
        ]);

        $address->update($request->only([
            'label', 'street', 'city', 'province', 'postal_code',
        ]));

        if ($request->boolean('is_default')) {
            // Unset other defaults
            auth()->user()->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
            $address->update(['is_default' => true]);
        }

        return redirect()->route('addresses.index')->with('success', 'Alamat berhasil diperbarui.');
    }

    public function destroy(Address $address)
    {
        $this->authorize('delete', $address);
        $address->delete();

        return back()->with('success', 'Alamat berhasil dihapus.');
    }
}

