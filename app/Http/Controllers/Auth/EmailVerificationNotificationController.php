<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification (API version).
     */
    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        // Check if email is already verified
        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email is already verified',
                'verified' => true
            ]);
        }

        // Send verification email
        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Verification link sent',
            'verified' => false
        ]);
    }
}
