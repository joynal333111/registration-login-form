<body>
    <h2>Hello {{ $user->name }},</h2>
    <p>Thank you for registering. Click the link below to verify your email:</p>
    <a href="{{ route('verify.email.link', ['token' => $token, 'email' => $user->email]) }}">
        Verify Email
    </a>
</body>
</html>
