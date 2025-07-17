<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChannelSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use App\Mail\ChannelLimitReached;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
        ]);

        $activeChannel = ChannelSetting::where('is_active', TRUE)->first();
        
        if (!$activeChannel) {
            return response()->json(['message' => 'No active channel available'], 400);
        }
        $pass = Str::random(8);
        $verificationCode = Str::random(6);
        $user = new User();
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->verification_code = $verificationCode;
        $user->telegram_channel_url = 'No Channel';
        $user->password = Hash::make($pass);
        



        Mail::to($user->email)->send(new VerificationEmail($user));
        $user->save();

        return response()->json(['message' => 'Registration successful. Please check your email for verification code.']);
    }

    public function verifyEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'verification_code' => 'required|string',
    ]);
    
    $user = User::where('email', $request->email)
                ->where('verification_code', $request->verification_code)
                ->first();

    if (!$user) {
        return response()->json(['message' => 'Invalid verification code'], 400);
    }

    $activeChannel = ChannelSetting::where('is_active', true)->first();

    if (!$activeChannel) {
        return response()->json(['message' => 'No active channel available'], 400);
    }

    $user->update([
        'is_verified' => true,
        'email_verified_at' => now(),
        'telegram_channel_url' => $activeChannel->telegram_channel_url,
        'verification_code' => $request->verification_code
    ]);
    $activeChannel->increment('user_count');

    if ($activeChannel->user_count >= 50) {
        $activeChannel->deactivate();

    
        Mail::to(env('ADMIN_EMAIL'))->send(new ChannelLimitReached($activeChannel));
    }

    
    return response()->json([
        'redirect_url' => $user->telegram_channel_url,
        'message' => 'Email verified successfully'
    ]);
}
}