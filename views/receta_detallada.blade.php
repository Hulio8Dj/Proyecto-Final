<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receta Detallada - El Rinconcito de Julito</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/Css/recetasXPais.css">
    <script src="src/javascript/receta_detallada.js"></script> 
</head>
<body>
<header class="bg-light border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center py-2">
        <div class="logo d-flex align-items-center justify-content-center flex-grow-1 text-center">
            <img src="src/imagenes/cocinera1.png" alt="Imagen izquierda" class="logo-image" style="height: 40px; margin-right: 10px;">
            <a href="index.php" class="h4 mb-0 text-decoration-none text-dark"><b>El Rinconcito de Julito</b></a>
            <img src="src/imagenes/cocinera1.png" alt="Imagen derecha" class="logo-image" style="height: 40px; margin-left: 10px;">
        </div>
        <div class="header-buttons d-flex align-items-center">
        <button class="btn btn-secondary" onclick="goBack()">Volver a Recetas por País</button>
        </div>
    </div>
</header>
<main class="container py-4">
    <section class="content">
        <h1 class="text-center mb-4">Receta Detallada</h1>
        <div class="recipe-detail card mb-4">
            <div class="row no-gutters">
                <div class="col-md-8">
                    <div class="card-body">
                        <h1 class="card-title">{{ $receta['nombre'] }}</h1>
                        <p class="card-text"><strong>Tiempo de preparación:</strong> {{ $receta['tiempoPreparacion'] }}</p>
                        <p class="card-text"><strong>Dificultad:</strong> {{ $receta['dificultad'] }}</p>

                        <div class="recipe-section">
                            <h3>Ingredientes:</h3>
                            <ul class="ingredients-list">
                                @if (!empty($receta['ingredientes']) && count($receta['ingredientes']) > 0)
                                    @foreach ($receta['ingredientes'] as $ingrediente)
                                        <li>{{ trim($ingrediente) }}</li>
                                    @endforeach
                                @else
                                    <li>No hay ingredientes disponibles.</li>
                                @endif
                            </ul>
                        </div>

                        <div class="recipe-section2">
                            <h3>Instrucciones:</h3>
                            <ul class="instructions-list">
                                @if (!empty($receta['instrucciones']) && count($receta['instrucciones']) > 0)
                                    @foreach ($receta['instrucciones'] as $instruccion)
                                        <li>{{ trim($instruccion) }}</li>
                                    @endforeach
                                @else
                                    <li>No hay instrucciones disponibles.</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="imagenes" class="col-md-4">
                    <img src="/src/Imagenes/fotosPlatos/{{ $receta['imagen'] }}" alt="{{ $receta['nombre'] }}" class="recipe-image card-img">
                </div>
            </div>
        </div>
    </section>
</main>

    <footer class="bg-light border-top py-4">
        <div class="container-footer">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="footer-description">
                        <b>El Rinconcito de Julito</b><br> Blog de cocina donde encontrarás recetas deliciosas y utensilios para hacer tu cocina más divertida.<br>
                        Síguenos en nuestras redes sociales o apúntate a nuestra Newsletter<br>
                        donde recibirás nuestras recetas, ofertas y todas las novedades.
                    </p>
                    <div class="footer-social mb-4">
                        <a href="https://www.facebook.com" target="_blank" class="social-icon" aria-label="Facebook">
                            <img src="src/imagenes/Facebook.png" alt="Facebook">
                        </a>
                        <a href="https://www.instagram.com" target="_blank" class="social-icon" aria-label="Instagram">
                            <img src="src/imagenes/instagram.png" alt="Instagram">
                        </a>
                        <a href="https://www.twitter.com" target="_blank" class="social-icon" aria-label="Twitter">
                            <img src="src/imagenes/twitter.png" alt="Twitter">
                        </a>
                    </div>
                    <div class="footer-newsletter">
                        <p>Suscríbete a nuestra newsletter:</p>
                        <form action="#" method="post" class="form-inline justify-content-center">
                            <div class="form-group mb-2">
                                <input type="email" name="email" class="form-control" placeholder="Introduce tu email" required>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 ml-2">Suscribirse</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
