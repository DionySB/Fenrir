<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Events\UserCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = User::orderBy('created_at')->get();
        return response()->json($users);
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $user = $this->userService->createUser($data);

        // Retorne a resposta adequada, como um JSON com o usuário criado
        return response()->json($user);
    }
    
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validated();
    
        $result = $this->userService->updateUser($user, $validatedData);
    
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 422);
        }
    
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