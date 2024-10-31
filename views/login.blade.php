<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="/src/Css/login.css">
    <script src="src/javascript/login.js"></script> 
</head>
<body>
    <main class="container py-4">
        <div class="formulario-recetas">
            <h2 class="mb-4">Registro de Usuario</h2>
            <form id="registroForm" action="/index.php?view=registrar" method="POST" onsubmit="return validarFormulario()">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
            <button onclick="validarYRedirigir()" class="btn btn-secondary mt-3">Iniciar Sesión</button>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>









