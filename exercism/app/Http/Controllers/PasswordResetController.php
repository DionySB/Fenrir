<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordReset extends Controller
{
    public function reset(PasswordResetRequest $request)
    {
        $email = $request->input('email');
        $token = $request->input('token');
        $password = $request->input('password');
        
        $passwordReset = PasswordReset::where('email', $email)->where('token', $token)->first();
    
        if (!$passwordReset) {
            return response()->json(['message' => 'Token inválido.'], 404);
        }
    
        $user = User::where('email', $email)->first();
    
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }
    
        $user->password = Hash::make($password);
        $user->save();
    
        $passwordReset->delete();
    
        return response()->json(['message' => 'Senha resetada com sucesso.']);
    }
}
