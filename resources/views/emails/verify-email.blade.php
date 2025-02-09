<body>
    <h2>Hello {{ $user->name }},</h2>
    <p>Thank you for registering. Your verification OTP is:</p>
    <h3>{{ $otp }}</h3>
    <p>This OTP will expire in 5 minutes.</p>
</body>
</html>
