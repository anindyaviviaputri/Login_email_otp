<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OtpCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_verified' => false, // Pastikan status verifikasi awal adalah false
        ]);

        // Hasilkan dan kirim OTP
        $this->generateAndSendOtp($user);

        return redirect()->route('verify.otp')->with('email', $user->email);
    }

    public function login(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Temukan pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek kredensial
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        // Hasilkan dan kirim OTP
        $this->generateAndSendOtp($user);

        return redirect()->route('verify.otp')->with('email', $user->email);
    }

    private function generateAndSendOtp($user)
    {
        // Hasilkan kode OTP 6 digit
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Simpan OTP ke database
        OtpCode::updateOrCreate(
            ['user_id' => $user->id],
            [
                'code' => $otp,
                'expire_at' => Carbon::now()->addMinutes(5)
            ]
        );

        // Kirim OTP melalui email
        Mail::raw("Your OTP code is: $otp", function($message) use ($user) {
            $message->to($user->email)
                    ->subject('OTP Verification');
        });
    }

    public function showVerifyOtp()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        // Validasi input OTP
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
        ]);

        // Temukan pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'User not found']);
        }

        // Cek kode OTP
        $otpCode = OtpCode::where('user_id', $user->id)
                         ->where('code', $request->otp)
                         ->where('expire_at', '>', Carbon::now())
                         ->first();

        if (!$otpCode) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        // Tandai pengguna sebagai terverifikasi
        $user->update(['is_verified' => true]);
        auth()->login($user);
        $otpCode->delete();

        return redirect()->route('home');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}