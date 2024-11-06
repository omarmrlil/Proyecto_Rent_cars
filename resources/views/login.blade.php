@extends('layout.app')

@section('content')
@if (session('usuario'))
    <p>Sesión iniciada para: {{ session('usuario')->nombre }} - Rol: {{ session('usuario')->rol }}</p>
@endif

<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar Sesión</button>
    </form>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
</div>

@if (session('message'))
    <div class="alert alert-warning">
        {{ session('message') }}
    </div>
@endif

@endsection
