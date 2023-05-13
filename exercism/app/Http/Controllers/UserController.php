<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id')->get();

        return response()->json(['data' => $users]);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active' => true,
        ]);

        return response()->json(['data' => $user], 201);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['data' => $user]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json(['data' => $user]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Usuário removido com sucesso.']);
    }

    public function trash($id)
    {
        $user = User::findOrFail($id);
        $user->active = false;
        $user->save();

        return response()->json(['message' => 'Usuário enviado para a lixeira.']);
    }

    public function untrash($id)
    {
        $user = User::findOrFail($id);
        $user->active = true;
        $user->save();

        return response()->json(['message' => 'Usuário recuperado da lixeira.']);
    }
}