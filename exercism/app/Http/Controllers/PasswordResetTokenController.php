<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PasswordResetToken;
use App\Http\Requests\PasswordResetTokenRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetTokenController extends Controller
{
    public function create(PasswordResetTokenRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        $token = Str::random(32);

        $passwordResetToken = PasswordResetToken::create([
            'user_id' => $user->id,
            'email' => $request->email,
            'token' => $token,
        ]);

        // TODO: Enviar email com link de redefinição de senha.

        return response()->json(['message' => 'Token de redefinição de senha criado com sucesso.']);
    }

    public function find($token)
    {
        $passwordResetToken = PasswordResetToken::where('token', $token)->first();

        if (!$passwordResetToken) {
            return response()->json(['message' => 'Token de redefinição de senha inválido.'], 404);
        }

        return response()->json(['data' => $passwordResetToken]);
    }

    public function reset(PasswordResetTokenRequest $request, $token)
    {
        $passwordResetToken = PasswordResetToken::where('token', $token)->first();

        if (!$passwordResetToken) {
            return response()->json(['message' => 'Token de redefinição de senha inválido.'], 404);
        }

        $user = $passwordResetToken->user;

        $user->password = Hash::make($request->password);
        $user->save();

        $passwordResetToken->delete();

        return response()->json(['message' => 'Senha alterada com sucesso.']);
    }
}