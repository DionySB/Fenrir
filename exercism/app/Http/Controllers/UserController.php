<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    public function index(){
        return User::All();
        
    }

    public function store(UserRequest $request){

        $user = User::create($request->validated());

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ]);
    }

    public function update(UserRequest $request) {

        $validated = $request->validated();
    }

    public function show(string $id)
    {
        return User::findOrFail($id);

    }

    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
    }

}
