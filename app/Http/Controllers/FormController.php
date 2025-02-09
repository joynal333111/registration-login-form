<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            // Prevent duplicate email registration
            if (User::where('email', $request->email)->exists()) {
                return redirect()->back()->withErrors([ 'email' => 'This email is already registered. Try logging in.' ]);
            }

            $validated                     = $request->validated();
            $validated[ 'password' ]       = bcrypt($validated[ 'password' ]);
            $validated[ 'otp' ]            = $validated[ 'verification_method' ] === 'otp' ? Str::upper(Str::random(2)) . rand(10, 99) : null;
            $validated[ 'otp_expires_at' ] = $validated[ 'verification_method' ] === 'otp' ? now()->addMinutes(5) : null;
            $validated[ 'is_verified' ]    = false;

            // Create user and set verification method
            $user = User::create($validated);

            // Store email in session for verification step
            session([ 'email' => $user->email ]);

            // Send OTP if "Send OTP" is selected
            if ($validated[ 'verification_method' ] === 'otp') {
                Mail::send('emails.verify-email', [
                    'user' => $user,
                    'otp'  => $validated[ 'otp' ],
                 ], function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('Verify Your Email - OTP');
                });

                return redirect()->route('verify.email')->with('success', 'An OTP has been sent to your email.');
            }

            // Send Verification Link if "Send Verification Link" is selected
            if ($validated[ 'verification_method' ] === 'link') {
                Mail::send('emails.verify-email-link', [
                    'user'  => $user,
                    'token' => $validated[ 'otp' ],
                 ], function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('Verify Your Email - Link');
                });

                return redirect()->route('login')->with('success', 'A verification link has been sent to your email.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    public function showVerifyEmailForm()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail(VerifyEmailRequest $request)
    {
        $validated = $request->validated();
        $email     = session('email') ?? $validated[ 'email' ];

        $user = User::where('email', $email)->first();

        if (! $user) {
            return back()->withErrors([ 'email' => 'User not found.' ]);
        }

        if ($user->otp !== $validated[ 'otp' ]) {
            return back()->withErrors([ 'otp' => 'Invalid OTP.' ]);
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors([ 'otp' => 'OTP has expired. Please request a new one.' ]);
        }

        //  Mark user as verified and clear OTP
        $user->is_verified    = true;
        $user->otp            = null;
        $user->otp_expires_at = null;
        $user->save();

        // Clear session email
        Session::forget('email');

        return redirect()->route('login')->with('success', 'Email verified successfully. You can now log in.');
    }

    public function verifyEmailWithLink($token, $email)
    {
        $user = User::where('email', $email)->where('otp', $token)->first();

        if (! $user) {
            return redirect()->route('register')->withErrors([ 'email' => 'No user found. Please register again.' ]);
        }

        if ($user->is_verified) {
            return redirect()->route('login')->with('success', 'Email already verified. You can log in.');
        }

        //  Mark user as verified
        $user->is_verified    = true;
        $user->otp            = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Email verified successfully. You can now log in.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        // Find user by email
        $user = User::where('email', $credentials[ 'email' ])->first();

        if (! $user) {
            return back()->withErrors([ 'email' => 'Invalid credentials.' ]);
        }

        // Prevent login if user is not verified
        if (! $user->is_verified) {
            return back()->withErrors([ 'email' => 'Your email is not verified. Please verify your email before logging in.' ]);
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }

        return back()->withErrors([ 'email' => 'Invalid credentials' ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
