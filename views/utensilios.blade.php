<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utensilios de Cocina</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/Css/submenu.css">
    <script src="src/javascript/utensilios.js"></script> 
    <style>
        /* Estilos para centrar el modal */
        .modal-dialog {
            margin: 50px auto; /* Asegura que el modal esté centrado verticalmente */
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a href="index.php" class="navbar-brand d-flex align-items-center">
                <img src="../src/imagenes/cocinera1.png" alt="Imagen izquierda" class="mr-2" style="width: 50px;">
                <span class="h4 mb-0" style="color: #304901;"><b>El Rinconcito de Julito</b></span>
                <img src="../src/imagenes/cocinera1.png" alt="Imagen derecha" class="ml-2" style="width: 50px;">
            </a>
            <!-- Enlace a la cesta -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?view=cesta">
                        Cesta
                        <img src="/src/imagenes/cesta.png" alt="Cesta" class="cart-icon">
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-4">
        <h1 class="text-center mb-4">Utensilios</h1>
        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-md-4 mb-4">
                    <div class="card" data-toggle="modal" data-target="#productModal" 
                         data-id="{{ $producto['id'] }}" 
                         data-nombre="{{ $producto['nombre'] }}" 
                         data-descripcion="{{ $producto['descripcion'] }}" 
                         data-precio="{{ $producto['precio'] }}">
                        <img src="src/imagenes/fotosProductos/{{ $producto['imagen'] }}" 
                             class="card-img-top" alt="{{ $producto['nombre'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto['nombre'] }}</h5>
                            <p class="card-text">€ {{ $producto['precio'] }}</p>
                            <button class="btn btn-primary add-to-cart" 
                                    data-id="{{ $producto['id'] }}" 
                                    data-nombre="{{ $producto['nombre'] }}" 
                                    data-precio="{{ $producto['precio'] }}">
                                Agregar a la cesta
                            </button>
                            <p class="alert-message"></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Detalles del Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="modalProductName"></h5>
                    <p id="modalProductDescription"></p>
                    <p><strong>Precio:</strong> <span id="modalProductPrice"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
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
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

