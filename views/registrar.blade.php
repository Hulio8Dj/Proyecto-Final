<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/src/Css/login.css">
    <script src="src/javascript/registrar.js"></script> 
</head>
<body>
    <header>
        <div class="container d-flex justify-content-between align-items-center py-2">
            <div class="logo text-center">
                <img src="../src/imagenes/cocinera1.png" alt="Imagen izquierda" class="logo-image" style="height: 50px;">
                <a href="/index.php" class="font-weight-bold"><b>El Rinconcito de Julito</b></a>
                <img src="../src/imagenes/cocinera1.png" alt="Imagen derecha" class="logo-image" style="height: 50px;">
            </div>
        </div>
    </header>
    <main class="container mt-4">
        <div class="formulario-recetas p-4 border rounded shadow-sm">
            <h2 class="text-success text-center mb-4">Registro de Usuario</h2>

             <!-- Mostrar el mensaje de éxito -->
            @if (isset($alertMessage))
                <div id="success-message" class="alert alert-success">
                    {{ $alertMessage }}
                </div>
            @endif

            <!-- Mostrar errores de validación -->
            @if (!empty($errors['general']))
                <div id="error-message" class="alert alert-danger">
                    {{ $errors['general'] }}
                </div>
            @endif

            <form id="registroForm" action="/index.php?view=registrar" method="POST" onsubmit="return validarFormulario()">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control {{ isset($errors['nombre']) ? 'is-invalid' : '' }}" 
                    required value="{{ $old['nombre'] ?? '' }}">
                    @if (isset($errors['nombre']))
                        <div class="invalid-feedback">
                            {{ $errors['nombre'] }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" 
                    class="form-control {{ isset($errors['email']) ? 'is-invalid' : '' }}" 
                    required value="{{ $old['email'] ?? '' }}" >
                    @if (isset($errors['email']))
                        <div class="invalid-feedback">
                            {{ $errors['email'] }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" class="form-control {{ isset($errors['contrasena']) ? 'is-invalid' : '' }}" 
                    required value="{{ $old['contrasena'] ?? ''}}">
                    @if (isset($errors['contrasena']))
                        <div class="invalid-feedback">
                            {{ $errors['contrasena'] }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                <button type="button" class="btn btn-secondary btn-block" onclick="redirectToLogin()">Iniciar Sesión</button>
            </form>
        </div>
    </main>
    
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

















