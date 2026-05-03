<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->user()->addresses()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'phone'      => 'required|string|max:20',
            'phone2'     => 'nullable|string|max:20',
            'address'    => 'required|string|max:255',
            'extra_info' => 'nullable|string|max:255',
            'region'     => 'required|string|max:100',
            'city'       => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $user = $request->user();

        // First address is always default
        $validated['is_default'] = $user->addresses()->count() === 0;
        $validated['user_id']    = $user->id;

        $address = Address::create($validated);

        return response()->json($address, 201);
    }

    public function update(Request $request, $id)
    {
        $address = Address::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'phone'      => 'required|string|max:20',
            'phone2'     => 'nullable|string|max:20',
            'address'    => 'required|string|max:255',
            'extra_info' => 'nullable|string|max:255',
            'region'     => 'required|string|max:100',
            'city'       => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        $address->update($validated);

        return response()->json($address);
    }

    public function destroy(Request $request, $id)
    {
        $address = Address::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $address->delete();

        return response()->json(['message' => 'Adresse supprimée.']);
    }
}
