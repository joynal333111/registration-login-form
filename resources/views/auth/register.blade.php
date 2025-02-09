@extends('layouts.main')

@section('content')
    <h2>Register</h2>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Name" required value="{{ old('name') }}">
        <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>
    <p class="link">Already have an account? <a href="{{ route('login') }}">Login</a></p>
@endsection
