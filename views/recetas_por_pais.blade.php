<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetas de {{ $pais }} - El Rinconcito de Julito</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/Css/recetaDetallada.css">
    <script src="src/javascript/receta_por_pais.js"></script> 
</head>
<body>
<header class="bg-light border-bottom shadow-sm">
        <div class="container d-flex justify-content-between align-items-center py-2">
            <div class="logo d-flex align-items-center justify-content-center flex-grow-1 text-center">
                <img src="src/imagenes/cocinera1.png" alt="Imagen izquierda" class="logo-image" style="height: 40px; margin-right: 10px;">
                <a href="index.php" class="h4 mb-0 text-decoration-none text-dark"><b>El Rinconcito de Julito</b></a>
                <img src="src/imagenes/cocinera1.png" alt="Imagen derecha" class="logo-image" style="height: 40px; margin-left: 10px;">
            </div>
        </div>
    </header>
    <main class="container py-4">
    <section class="content">
        <h1 class="text-center mb-4">Recetas de {{ $pais }}</h1>
        <div class="recipes-container">
            <div class="row">
                @if (count($recetas) > 0)
                    @foreach ($recetas as $receta)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <a href="index.php?view=receta_detallada&id={{ $receta['id'] }}">
                                    <img src="/src/Imagenes/fotosPlatos/{{ $receta['imagen'] }}" alt="{{ $receta['nombre'] }}" class="card-img-top">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $receta['nombre'] }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">No hay recetas disponibles para {{ $pais }}.</p>
                @endif
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
                </div>
            </div>
        </div>
    </footer>
</body>
</html>





