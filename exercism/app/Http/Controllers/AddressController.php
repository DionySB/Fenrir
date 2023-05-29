<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Http\Requests\addressRequest;
use Illuminate\Support\Facades\Log;


class AddressController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
      return view('addresses.index', compact('addresses'));
    }

    public function create(addressRequest $request)
    {
        $data = $request->validate($request->store());
        
        $address = $this->addressService->createaddress($data);

        return response()->json($address);
    }
    
    public function update(addressRequest $request, $id)
    {
        $address = address::findOrFail($id);
        $data = $request->validate($request->update());
        $result = $this->addressService->updateaddress($address, $data);
    
        return response()->json([
            'message' => 'address updated successfully',
            'data' => $result
        ]);
    }

    public function show($id)
    {
        $address = address::findOrFail($id);
        return response()->json($address);

    }

    public function destroy(string $id)
    {
        $address = address::findOrFail($id);
        $address->delete();
        return response()->json(['message' => 'address deleted successfully'], 200);

    }

    public function trash(string $id)
    {
        $address = address::findOrFail($id);
        $address->active = false;
        $address->save();
        return response()->json(['message' => 'address trashed successfully'], 200);
    }
    
    public function untrash($id)
    {
        $address = Address::findOrFail($id);
        $address->active = true;
        $address->save();
        return response()->json(['message' => 'address untrashed successfully'], 200);
    }

}