<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Illuminate\Http\Request;
use App\Http\Requests\GymRequest;

class GymController extends Controller
{
    public function __construct()
    {
        
    }

    public function showGyms()
    {
        $gyms = Gym::all();
        return view('pages.gyms', compact('gyms'));
    }

    public function index()
    {
        $gyms = Gym::all();
        return response()->json($gyms);
    }

    public function create(GymRequest $request)
    {
        $data = $request->validate($request->store());
        $gym = Gym::create($data);

        return response()->json($gym);
    }

    public function update(GymRequest $request, $id)
    {
        $Gym = Gym::findOrFail($id);
        $data = $request->validate($request->update());
        $Gym->update($data);

        return response()->json([
            'message' => 'Gym updated successfully',
            'data' => $Gym
        ]);
    }

    public function show($id)
    {
        $Gym = Gym::findOrFail($id);
        return response()->json($Gym);
    }

    public function destroy($id)
    {
        $Gym = Gym::findOrFail($id);
        $Gym->delete();
        return response()->json(['message' => 'Gym deleted successfully'], 200);
    }

    public function trash($id)
    {
        $Gym = Gym::findOrFail($id);
        $Gym->active = false;
        $Gym->save();
        return response()->json(['message' => 'Gym trashed successfully'], 200);
    }

    public function untrash($id)
    {
        $Gym = Gym::findOrFail($id);
        $Gym->active = true;
        $Gym->save();
        return response()->json(['message' => 'Gym untrashed successfully'], 200);
    }
}