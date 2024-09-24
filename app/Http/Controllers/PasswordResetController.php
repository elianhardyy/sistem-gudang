<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function forgotPassword(Request $request) {
        // Validate email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Email is required and should exist in our records',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Send reset password email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'Password reset link sent to your email address.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send password reset link. Please try again later.'
            ], 500);
        }
    }

    public function resetPassword(Request $request) {
        $token = $request->query('token');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed', // password confirmation is required
        ]);
        //$validator['token'] = $token;

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }
        // echo $token;
        // Attempt to reset the password
        $status = Password::reset(
            array_merge(
                $request->only('email','password', 'password_confirmation'),
                ['token'=>$token]
            ),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        // Respond based on the status
        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'success' => true,
                'message' => 'Password has been successfully reset.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reset password. Invalid token or email.'
            ], 500);
        }
    }
}
