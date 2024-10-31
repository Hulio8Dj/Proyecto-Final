<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cesta</title>
    <link rel="stylesheet" href="../src/Css/cesta.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="src/javascript/cesta.js"></script> 
</head>
<body>
    <div class="container">
        <div id="alert-message" class="alert alert-danger" style="display:none;"></div>
        <!--<pre>{{serialize($_SESSION['cart'])}}</pre>-->
        @if(empty($productos))
            <div class="alert alert-info">
                <h1>Tu cesta en "El Rinconcito de Julito" está vacía.</h1>
                <p>No hay productos en tu cesta.</p>
                <a href="index.php?view=principal" class="btn btn-primary">Volver a la página principal</a>
            </div>
            <!-- Imagen debajo de la tabla -->
            <div class="text-center mt-4">
                <img src="/src/Imagenes/caraTriste.jpeg" alt="Imagen de la cesta" class="img-cesta">
            </div>
        @else
            <h1>Tu cesta en "El Rinconcito de Julito" tiene cositas.</h1>
            <table class="table" id="cesta-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr data-producto-id="{{ $producto['id'] }}">
                            <td>{{ $producto['nombre'] }}</td>
                            <td>{{ number_format($producto['precio'], 2) }} €</td>
                            <td id="cantidad-{{ $producto['id'] }}">
                                <div class="quantity-controls">
                                    <button onclick="actualizarCantidad({{ $producto['id'] }}, -1)" class="btn btn-secondary">-</button>
                                    <span>{{ $producto['cantidad'] }}</span>
                                    <button onclick="actualizarCantidad({{ $producto['id'] }}, 1)" class="btn btn-secondary">+</button>
                                </div>    
                            </td>
                            <td id="total-{{ $producto['id'] }}"> {{ number_format($producto['precio'] * $producto['cantidad'], 2) }} €</td>
                            <td>
                                <button onclick="eliminarArticulo({{ $producto['id'] }})" class="btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3 id="total-cesta">Total: {{ number_format($total, 2) }} €</h3>

             <!-- Nuevo botón para finalizar la compra -->
             <a href="index.php?view=finalizarCompra" class="boton boton-primary finalizar-compra-boton">Finalizar Compra</a><br>
             <a href="index.php?view=principal" class="btn btn-primary">Volver a la página principal</a>

        @endif
    </div>
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













