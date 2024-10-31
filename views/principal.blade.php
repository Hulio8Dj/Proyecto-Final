<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rinconcito de Julito</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/Css/style.css">
    <script src="src/javascript/principal.js"></script> 
</head>
<body>
<header>
    <div class="container">
        <div class="row justify-content-between align-items-center py-3 header-top">
            <div class="col-auto">
                @if (isset($_SESSION['user_nombre']))
                <div class="dropdown">
                <span class="btn btn-link dropdown-toggle" id="dropdownUserMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hola, {{ $_SESSION['user_nombre'] }}!
                </span>
                <div class="dropdown-menu" aria-labelledby="dropdownUserMenu">
                    <a class="dropdown-item" href="views/misDatos.blade.php">Mis Datos</a>
                    <a class="dropdown-item" href="views/misPedidos.blade.php">Mis Pedidos</a>
                </div>
                <a href="index.php?view=logout" class="btn btn-link">Cerrar Sesión</a>
            </div>
                    
                @else
                    <a href="index.php?view=registrar" class="btn btn-link">Registrarse</a>
                    <a href="index.php?view=inicioSesion" class="btn btn-link">Iniciar Sesión</a>
                @endif
            </div>
            <div class="col text-center">
                <div class="logo">
                    <img src="/src/imagenes/cocinera1.png" alt="Imagen izquierda" class="logo-image">
                    <a href="index.php">El Rinconcito de Julito</a>
                    <img src="/src/imagenes/cocinera1.png" alt="Imagen derecha" class="logo-image">
                </div>
            </div>
            <div class="col-auto d-flex justify-content-end">
                <a href="index.php?view=cesta" class="btn btn-link">
                    Cesta
                    <img src="/src/imagenes/cesta.png" alt="Cesta" class="cart-icon">
                </a>
                <div class="col-auto text-right">
                    <div class="despegable-busqueda" id="despegable-busqueda">
                        Buscador
                        <img src="/src/imagenes/lupa.jpg" alt="Buscar" class="search-icon">
                    </div>
                <div id="searchContainer" style="display: none;">
            </div>
        </div>
            </div>
        </div>
     </div>
        <div class="header-bottom">
            <nav class="navbar navbar-expand-md navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRecetas" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Más Recetas
                        </a>
                        <div class="dropdown-menu dropdown-menu-recetas" aria-labelledby="navbarDropdownRecetas">
                            <a class="dropdown-item" href="index.php?view=recetas_por_pais&pais=España">
                                <img src="/src/Imagenes/fotosBanderas/España.png" alt="España">España
                            </a>
                            <a class="dropdown-item" href="index.php?view=recetas_por_pais&pais=Mexico">
                                <img src="/src/Imagenes/fotosBanderas/mexico.png" alt="México">México
                            </a>
                            <a class="dropdown-item" href="index.php?view=recetas_por_pais&pais=Alemania">
                                <img src="/src/Imagenes/fotosBanderas/alemania.png" alt="Alemania">Alemania
                            </a>
                            <a class="dropdown-item" href="index.php?view=recetas_por_pais&pais=Peru">
                                <img src="/src/Imagenes/fotosBanderas/peru.jpg" alt="Peru">Perú
                            </a>
                        </div>
                    </li>

                        <li class="nav-item"><a class="nav-link" href="index.php?view=cocinar">Cocinar</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?view=utensilios">Utensilios</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?view=reposteria">Repostería</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?view=electrodomestico">Electrodomésticos</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    
</div>
</header>

<main>
    <section class="content">
        <div class="container">
            <div class="row">
                <!-- Imagen para recetas italianas -->
                <div class="col-md-4 mb-4">
                    <a href="index.php?view=recetas_por_pais&pais=Italia">
                        <img src="src/imagenes/italiana.jpeg" alt="Recetas Italianas" class="recipe-link-image img-fluid">
                    </a>
                </div>

                <!-- Imagen para recetas francesas -->
                <div class="col-md-4 mb-4">
                    <a href="index.php?view=recetas_por_pais&pais=Francia">
                        <img src="src/imagenes/francesa.jpg" alt="Recetas Francesas" class="recipe-link-image img-fluid">
                    </a>
                </div>

                <!-- Imagen para recetas japonesas -->
                <div class="col-md-4 mb-4">
                    <a href="index.php?view=recetas_por_pais&pais=Japon">
                        <img src="src/imagenes/japonesa.jpg" alt="Recetas Japonesas" class="recipe-link-image img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<footer>
    <div class="container footer-content text-center py-4">
        <p>
            <b>El Rinconcito de Julito</b><br> Blog de cocina donde encontrarás recetas deliciosas y utensilios para hacer tu cocina más divertida.<br>
            Síguenos en nuestras redes sociales o apúntate a nuestra Newsletter<br>
            donde recibirás nuestras recetas, ofertas y todas las novedades.
        </p>
        <div class="footer-social mb-3">
            <a href="https://www.facebook.com" target="_blank" class="social-icon" aria-label="Facebook">
                <img src="/src/imagenes/Facebook.png" alt="Facebook">
            </a>
            <a href="https://www.instagram.com" target="_blank" class="social-icon" aria-label="Instagram">
                <img src="/src/imagenes/instagram.png" alt="Instagram">
            </a>
            <a href="https://www.twitter.com" target="_blank" class="social-icon" aria-label="Twitter">
                <img src="/src/imagenes/twitter.png" alt="Twitter">
            </a>
        </div>
        <!-- Formulario de suscripción al boletín en el footer -->
<div class="footer-newsletter">
    <p>Suscríbete a nuestra newsletter:</p>
    <form action="index.php" method="post" class="form-inline justify-content-center">
        <input type="email" name="email" placeholder="Introduce tu email" class="form-control mr-2" required>
        <button type="submit" name="subscribe" class="btn btn-primary">Suscribirse</button>
    </form>
    <!-- Mostrar mensaje de alerta -->
    @if(isset($alertMessage))
       <p class="alert-message">{{ $alertMessage }}</p>
    @endif
</div>

    </div>
    <div id="sideMenu">
        <button id="closeButton">X</button>
        <section class="search-container">
            <h1 class="mb-4">Buscador de Productos</h1>
            <form action="index.php" method="get" onsubmit="return false;" class="form-inline">
                <input type="hidden" name="view" value="resultados_busqueda">
                <input type="text" name="q" placeholder="Buscar productos..." required onkeyup="buscarProductos(this.value)" class="form-control mr-2">
            </form>
            <div class="search-results-container mt-4">
                <ul id="resultados-autocompletado" class="list-unstyled"></ul>
            </div>
        </section>  
    </div>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

