<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
    
        return response()->json($users->toArray());
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->validated());

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ]);
    }
    public function trash(UserRequest $request, $id)
    {
        $validated = $request->validate($request->rulesForTrash());
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