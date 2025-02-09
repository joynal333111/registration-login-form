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

        <p>Select verification method:</p>

        <div class="checkbox-group">
            <label>
                <input type="checkbox" id="send_otp" name="verification_method" value="otp" onclick="toggleCheckbox('send_otp')">
                Send OTP
            </label>

            <label>
                <input type="checkbox" id="send_link" name="verification_method" value="link" onclick="toggleCheckbox('send_link')">
                Send Verification Link
            </label>
        </div>

        <button type="submit">Register</button>
    </form>

    <p class="link">Already have an account? <a href="{{ route('login') }}">Login</a></p>

    <script>
        function toggleCheckbox(selectedId) {
            let otpCheckbox = document.getElementById('send_otp');
            let linkCheckbox = document.getElementById('send_link');

            if (selectedId === 'send_otp') {
                linkCheckbox.checked = false;
            } else if (selectedId === 'send_link') {
                otpCheckbox.checked = false;
            }
        }
    </script>
@endsection
