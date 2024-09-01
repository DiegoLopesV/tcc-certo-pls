
<!DOCTYPE html>
<html>
<head>
    <title>Redefinir Senha</title>
</head>
<body>
    <h1>Redefinir Senha</h1>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email">E-Mail Address</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Send Password Reset Link</button>
    </form>
</body>
</html>
