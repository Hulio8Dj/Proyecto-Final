<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/src/Css/pedidos.css"> <!-- CSS Personalizado -->
    <title>Mis Pedidos</title>
</head>
<body>
    <div class="container">
        <h3>Mis Pedidos</h3>

        <div class="table-responsive">
        <table class="table table-striped table-bordered mt-4">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>NºPedido</th>
                    <th>Precio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>15/5/23</td>
                    <td>A/1234</td>
                    <td>50 €</td>
                    <td><span class="badge badge-success">Entregado</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>22/5/24</td>
                    <td>A/3659</td>
                    <td>100 €</td>
                    <td><span class="badge badge-warning">Preparando</span></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>31/12/23</td>
                    <td>A/8569</td>
                    <td>75,20 €</td>
                    <td><span class="badge badge-danger">Cancelado</span></td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class="text-center">
            <a href="../index.php" class="btn btn-primary btn-custom">Volver a la Página Principal</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script> <!-- Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
</body>
</html>
