<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="../src/Css/finalizarCompra.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="src/javascript/finalizarCompra.js"></script> 
</head>
<body>
    <div class="container finalizar-compra-container">
        <h1>Finalizar Compra</h1>

        <div class="flex-container">
            <div class="resumen-productos">
                <h2>Resumen de tu pedido</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto['nombre'] }}</td>
                                <td>{{ $producto['cantidad'] }}</td>
                                <td>{{ number_format($producto['precio'] * $producto['cantidad'], 2) }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h3>Total de la compra: {{ number_format($total, 2) }} € </h3>
            </div>

            <div class="datos-cliente">
                <h2>Datos del Cliente</h2>
                <form action="index.php?view=finalizarCompra" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required value="{{ $nombreCompleto }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required value="{{ $email }}">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección de Envío</label>
                        <textarea class="form-control short-textarea" id="direccion" name="direccion" required>{{ $direccion }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="numero_tarjeta" class="form-label">Número de Tarjeta</label>
                        <input type="text" class="form-control" id="numero_tarjeta" name="numero_tarjeta" required maxlength="19" oninput="formatearTarjeta(this)" value="{{ $numeroTarjeta }}">
                    </div>
                    <button type="submit" class="btn btn-success">Confirmar Compra</button>
                </form>

                @if(isset($mensajeConfirmacion))
                    <div class="mensaje-confirmacion mt-3">
                    <p>{!! $mensajeConfirmacion !!}</p>
                    </div>
                @endif
            </div>
        </div>

        <a href="index.php?view=principal" class="btn btn-secondary volver-cesta-btn">Volver al Inicio</a>
    </div>
</body>
</html>

