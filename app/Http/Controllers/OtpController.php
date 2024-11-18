<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showVerifyOtp()
    {
        if (Auth::user()->otp_verified) {
            return redirect()->route('home');
        }
        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|numeric',
        ]);

        // Debug: Cek nilai OTP yang diinput
        $inputOtp = implode('', $request->otp);
        
        // Debug: Cek nilai OTP di database
        $user = Auth::user();
        $storedOtp = $user->otp;

        // Tambahkan logging untuk debugging
        \Log::info('Input OTP: ' . $inputOtp);
        \Log::info('Stored OTP: ' . $storedOtp);

        // Bandingkan sebagai string
        if ((string)$inputOtp === (string)$storedOtp) {
            $user->otp_verified = true;
            $user->save();

            return redirect()->route('home')->with('success', 'OTP verified successfully!');
        }

        return back()->with('error', 'Invalid OTP. Please try again.');
    }

    public function resend()
    {
        $user = Auth::user();
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $user->otp = $otp;
        $user->otp_verified = false;
        $user->save();

        // Debug: Log OTP yang dikirim
        \Log::info('Resent OTP: ' . $otp . ' for user: ' . $user->email);

        Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));

        return back()->with('success', 'New OTP has been sent to your email.');
    }
}