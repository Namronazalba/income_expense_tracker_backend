<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;

// ----------- AUTH ROUTES -----------
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Logout (requires authentication)
Route::middleware('auth:sanctum')->post('/logout', [AuthenticatedSessionController::class, 'destroy']);

// Password reset request
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

// Reset password
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');

// Verify email (requires signed URL)
Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->name('verification.verify');

// Resend verification email (requires authentication)
Route::middleware('auth:sanctum')->post(
    '/email/verification-notification',
    [EmailVerificationNotificationController::class, 'store']
)->name('verification.send');
