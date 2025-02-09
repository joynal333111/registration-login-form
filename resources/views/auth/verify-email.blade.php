@extends('layouts.main')

@section('content')
    <h2>Email Verification</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p>Your verification code has been sent to <strong>{{ session('email') }}</strong>. Please enter the OTP below to verify your email.</p>

    <form method="POST" action="{{ route('verify.email') }}">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button type="submit">Verify Email</button>
    </form>
    <p>This OTP will expire in 2 minutes.</p>

    <p>If you didn't receive an email, <a href="{{ route('register') }}">register again</a>.</p>
@endsection
