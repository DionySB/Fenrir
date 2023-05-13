<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
    
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }
    
        $token = Str::random(60);
    
        PasswordReset::create([
            'email' => $email,
            'token' => $token
        ]);
    
        $user->sendPasswordResetNotification($token);
    
        return response()->json(['message' => 'Email de recuperação de senha enviado com sucesso.']);
    }
    
}
