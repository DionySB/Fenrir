<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Events\UserCreated;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        Log::debug("teste");
        $users = User::orderBy('created_at')->get();
        return response()->json($users);

    }

    public function store(UserRequest $request) {
        $validated = $request->validated();
    
        $user = new User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();
        event(new Registered($user));
        return response()->json([
            'message' => 'user create sucessful',
            'user' => $user,
        ], 201);


        
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validated();
        if (isset($validatedData['password']) && !empty($validatedData['password'])) {
            if ($validatedData['password_confirmation'] != $validatedData['password']) {
                return response()->json(['error' => 'Password confirmation does not match'], 422);
            }
            $user->password = bcrypt($validatedData['password']);
            unset($validatedData['password']);
            unset($validatedData['password_confirmation']);
        }
        $user->fill($validatedData);
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

    public function destroy(string $id)
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

    public function verifyEmail($id, $hash)
    {
        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail()) {
            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
        }

        return redirect('/home');
    }
}