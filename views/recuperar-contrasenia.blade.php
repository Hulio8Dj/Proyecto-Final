<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/src/Css/login.css">
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
            <h2 class="text-success text-center mb-4">Recuperar Contraseña</h2>
            <!-- Contenedor para el mensaje de alerta -->
                <?php if (isset($alertMessage) && !empty($alertMessage)): ?>
                    <div class="alert alert-info text-center mb-4">
                        <?php echo htmlspecialchars($alertMessage); ?>
                    </div>
                <?php endif; ?>
            <form id="recoverPasswordForm" action="/index.php?view=recuperar-contrasenia" method="POST">
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Enviar Enlace de Recuperación</button>

                <!-- Enlace para volver al inicio de sesión -->
                <div class="text-center mt-3">
                    <a href="/index.php" class="text-secondary">Volver a la pantalla de Inicio</a>
                </div>
            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
