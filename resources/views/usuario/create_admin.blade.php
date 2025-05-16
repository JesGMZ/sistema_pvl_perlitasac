<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Administrador</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="login-body">

    <div class="login-container">
        <div class="login-box text-center">
            <img src="{{ asset('images/leche.png') }}" alt="Logo" class="login-logo">
            <h2 class="mb-4 text-white">Crear Administrador</h2>

            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0 text-start">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('usuario.registrar_admin') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" required>
                    <label for="name">Nombre completo</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Correo electrónico" required>
                    <label for="email">Correo electrónico</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required>
                    <label for="password">Contraseña</label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-success btn-lg">Registrar Administrador</button>
                </div>

                <div class="mt-3">
                    <a href="{{ route('login') }}" class="text-white text-decoration-underline">Volver al login</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>