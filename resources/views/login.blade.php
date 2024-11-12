<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Iniciar Sesión</title>
</head>
<body>

<div class="login-container">
    <div class="image-container">
        <img src="{{ asset('images/car.jpeg') }}" alt="Auto de Login">
    </div>
    <div class="form-container">
    <i class="fas fa-user fa-3x"></i>
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <p class="register-link">¿No tiene una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
</div>

</body>
</html>
