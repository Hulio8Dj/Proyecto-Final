<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
    <link rel="stylesheet" href="../src/Css/producto_detallado.css">
    <script src="src/javascript/producto_detallado.js"></script> 
</head>
<body>
    <main>
        <!-- Sección del producto con ID único -->
        <section id="producto-{{ $producto['id'] }}" class="producto-detalle">
            <h1>{{ $producto['nombre'] }}</h1>
            <div class="producto-imagenes">
                @foreach ($imagenes as $imagen) <!-- Asegúrate de usar la variable correcta -->
                    <img src="/src/Imagenes/fotosProductos/{{ $imagen }}" alt="{{ $producto['nombre'] }}">
                @endforeach
            </div>
            <p>{{ $producto['descripcion'] }}</p>
            <p>Precio: ${{ $producto['precio'] }}</p>
            <button class="add-to-cart-btn">Añadir a la Cesta</button>
        </section>
    </main>
</body>
</html>






