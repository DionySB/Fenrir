<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $addresses = Address::all();
        return response()->json($addresses);
    }

    public function create(AddressRequest $request)
    {
        $data = $request->validate($request->store());
        $address = Address::create($data);

        return response()->json($address);
    }

    public function update(AddressRequest $request, $id)
    {
        $address = Address::findOrFail($id);
        $data = $request->validate($request->update());
        $address->update($data);

        return response()->json([
            'message' => 'Address updated successfully',
            'data' => $address
        ]);
    }

    public function show($id)
    {
        $address = Address::findOrFail($id);
        return response()->json($address);
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return response()->json(['message' => 'Address deleted successfully'], 200);
    }

    public function trash($id)
    {
        $address = Address::findOrFail($id);
        $address->active = false;
        $address->save();
        return response()->json(['message' => 'Address trashed successfully'], 200);
    }

    public function untrash($id)
    {
        $address = Address::findOrFail($id);
        $address->active = true;
        $address->save();
        return response()->json(['message' => 'Address untrashed successfully'], 200);
    }
}
