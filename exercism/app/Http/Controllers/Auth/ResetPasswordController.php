<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\Auth\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showEmailForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'The email entered does not belong to our database.',
        ]);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? redirect()->back()->with('status', 'Password reset link has been sent to your email.')
            : redirect()->back()->withErrors(['email' => __($response)]);
    }

    public function showResetForm($token, $email)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = $this->broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Your password has been reset.')
            : redirect()->back()->withErrors(['email' => __($response)]);
    }

    protected function broker()
    {
        return Password::broker();
    }
}
