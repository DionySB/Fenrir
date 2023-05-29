<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Events\UserRegistered;
use App\Services\UserService;
use Illuminate\Auth\Events\Verified;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = User::with('address', 'address.user', 'profile')->get();
        return response()->json($users);
    }

    public function create(UserRequest $request)
    {
        $data = $request->validate($request->store());
        
        $user = $this->userService->createUser($data);

        return response()->json($user);
    }
    
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate($request->update());
        $result = $this->userService->updateUser($user, $data);
    
        return response()->json([
            'message' => 'User updated successfully',
            'data' => $result
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