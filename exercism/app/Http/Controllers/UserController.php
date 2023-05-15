<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at')->get();
        return response()->json($users);

    }

    public function store(UserRequest $request) {
        $validated = $request->validated();
    
        $user = new User;
        $user->password = Hash::make($request->input('password'));
        $user->save();
    
        return response()->json([
            'message' => 'user create sucessful',
            'user' => $user,
        ], 201);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->validated());
        $user->save();
        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user
        ]);

    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);

    }

    public function destroy(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);

    }

    public function trash(string $id)
    {
        $user = User::findOrFail($id);
        $user->active = false;
        $user->save();
        return response()->json(['message' => 'User trashed successfully'], 200);
    }
    
    public function untrash($id)
    {
        $user = User::findOrFail($id);
        $user->active = true;
        $user->save();
        return response()->json(['message' => 'User untrashed successfully'], 200);
    }
}