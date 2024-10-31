<?php

session_start();
require "vendor/autoload.php";

use eftec\bladeone\BladeOne;

// Configuración de Blade
$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);

/*----------------------------------------------------------------------------------------------------------------------*/

/*ESPACIO PARA LAS FUNCIONES DE VALIDACIÓN*/

// Funciones de validación
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Funcion para validar la contraseña
function validarContrasena($contrasena) {
    $pattern = '/^(?=.*[A-Z])(?=.*[!@#$%^&*?])[A-Za-z\d!@#$%^&*?]{8,}$/';
    return preg_match($pattern, $contrasena);
}

// Función para validar el número de tarjeta usando el algoritmo de Luhn
function esNumeroTarjetaValido($numeroTarjeta) {
    // Quitar espacios y caracteres no numéricos
    $numero = preg_replace('/\D/', '', $numeroTarjeta);

    // Verificar longitud estándar (13 a 19 dígitos)
    $longitud = strlen($numero);
    if ($longitud < 13 || $longitud > 19) {
        return false; // Longitud inválida
    }

    // Verificar prefijo para tipos de tarjetas comunes
    if ((substr($numero, 0, 1) === '4' && ($longitud == 13 || $longitud == 16)) || // Visa
        (substr($numero, 0, 2) >= '51' && substr($numero, 0, 2) <= '55' && $longitud == 16) || // MasterCard
        ((substr($numero, 0, 2) === '34' || substr($numero, 0, 2) === '37') && $longitud == 15) || // American Express
        (substr($numero, 0, 4) === '6011' && $longitud == 16)) { // Discover
        return true;
    }

    return false; // No coincide con prefijos válidos
}


/*ESPACIO PARA LAS FUNCIONES DE VALIDACIÓN*/

/*----------------------------------------------------------------------------------------------------------------------*/

/*AQUÍ COMIENZA EL CÓDIGO PHP*/

// Conexión a la base de datos
try {
    $db = new PDO('mysql:host=localhost;dbname=risasysabores', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}

// Inicializar carrito en la sesión
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


// Manejo de cierre de sesión
if (isset($_GET['view']) && $_GET['view'] === 'logout') {
    // Limpiar todas las variables de sesión
    $_SESSION = [];

    // Destruir la sesión
    session_destroy();

    // Redirigir con JavaScript
    echo "<script>
            window.location.href = 'index.php?view=principal';
          </script>";
    exit;
}

// Manejo de suscripción al boletín
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    
    if (validarEmail($email)) {
        try {
            // Verificar si el email ya está suscrito
            $sql = "SELECT COUNT(*) FROM suscripciones WHERE email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $exists = $stmt->fetchColumn();

            if ($exists > 0) {
                $alertMessage = 'El correo electrónico ya está suscrito.';
            } else {
                // Insertar el nuevo email
                $sql = "INSERT INTO suscripciones (email, fecha) VALUES (:email, NOW())";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $alertMessage = '¡Suscripción exitosa!';
            }
        } catch (PDOException $e) {
            $alertMessage = 'Error al suscribirse: ' . $e->getMessage();
        }
    } else {
        $alertMessage = 'Email no válido.';
    }
}

// Manejo del carrito

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        if ($action === 'remove' && isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function($item) use ($id) {
                return $item['id'] != $id;
            }));
        
            $isEmpty = empty($_SESSION['cart']);
            echo json_encode(['success' => true, 'empty' => $isEmpty]);
            exit();
        }
        
        if ($action === 'update' && isset($_POST['id']) && isset($_POST['cantidad'])) {
            $id = intval($_POST['id']);
            $cantidad = intval($_POST['cantidad']);
            
            // Actualiza la cantidad del artículo en el carrito
            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $id) {
                    if ($cantidad <= 0) {
                        // Si la cantidad es menor o igual a 0, elimina el artículo
                        $_SESSION['cart'] = array_filter($_SESSION['cart'], function($i) use ($id) {
                            return $i['id'] !== $id;
                        });
                        $_SESSION['cart'] = array_values($_SESSION['cart']);
                    } else {
                        // Actualiza la cantidad del artículo
                        $item['cantidad'] = $cantidad;
                    }
                    $found = true;
                    break;
                }
            }
            
            if (!$found && $cantidad > 0) {
                // Si no se encontró el artículo en el carrito, agrégalo
                $_SESSION['cart'][] = ['id' => $id, 'cantidad' => $cantidad];
            }
            
            // Calcula el total del carrito
            $total = 0;
            foreach ($_SESSION['cart'] as &$item) {
                $sql = "SELECT precio FROM productos WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $item['id']);
                $stmt->execute();
                $producto = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($producto) {
                    $total += $producto['precio'] * $item['cantidad'];
                }
            }
            
            echo json_encode(['success' => true, 'precioTotal' => $total, 'cart' => serialize($_SESSION['cart'])]);
            
            exit();
        }
    }
}

// Obtención de la vista solicitada
$view = filter_input(INPUT_GET, 'view') ?? 'principal';

try {
    switch ($view) {
        case 'recetas_por_pais':
            $pais = filter_input(INPUT_GET, 'pais') ?? 'Italia';
            $sql = "SELECT id, nombre, paisOrigen, tiempoPreparacion, dificultad, ingredientes, instrucciones, imagen FROM recetas WHERE paisOrigen = :pais";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':pais', $pais);
            $stmt->execute();
            $recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($recetas as &$receta) {
                if (isset($receta['ingredientes'])) {
                    $receta['ingredientes'] = explode(",", $receta['ingredientes']);
                }
                if (isset($receta['instrucciones'])) {
                    $receta['instrucciones'] = explode("\n", $receta['instrucciones']);
                }
            }
            echo $blade->run("recetas_por_pais", ["recetas" => $recetas, "pais" => $pais]);
            break;

        case 'buscar_productos_ajax':
        case 'resultados_busqueda':
            $consulta = filter_input(INPUT_GET, 'q') ?? '';
            $sql = "SELECT nombre, categoria, descripcion, precio, imagen FROM productos WHERE nombre LIKE :consulta";
            $stmt = $db->prepare($sql);
            $busqueda = "%$consulta%";
            $stmt->bindParam(':consulta', $busqueda);
            $stmt->execute();
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if ($view === 'buscar_productos_ajax') {
                    // Respuesta para AJAX (JSON)
                    echo json_encode($productos);
                    exit;
                } elseif ($view === 'resultados_busqueda') {
                    // Respuesta para renderizado HTML
                    echo $blade->run("resultados_busqueda", ["productos" => $productos]);
                }
                break;
                

        case 'registrar':
            $errors = []; // Inicializamos el array de errores
            $old = []; // Inicializamos el array de valores antiguos
                
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombreCompleto = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING) ?? '';
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
                $contrasena = filter_input(INPUT_POST, 'contrasena') ?? '';
            
                // Guardamos los valores antiguos
                $old['nombre'] = $nombreCompleto;
                $old['email'] = $email;
                $old['contrasena'] = $contrasena;
            
                // Validar nombre completo
                if (empty($nombreCompleto)) {
                    $errors['nombre'] = 'El nombre completo es requerido.';
                }
            
                // Validar correo electrónico
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 'Correo electrónico inválido.';
                }
            
                // Validar contraseña
                if (!validarContrasena($contrasena)) {
                    $errors['contrasena'] = 'La contraseña debe tener al menos 8 caracteres, una mayúscula y un carácter especial.';
                }
            
                // Solo proceder si no hay errores
                if (empty($errors)) {
                    try {
                        $sql = "SELECT COUNT(*) FROM usuario WHERE correoElectronico = :correoElectronico";
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':correoElectronico', $email);
                        $stmt->execute();
                        $exists = $stmt->fetchColumn();
            
                        if ($exists > 0) {
                            $errors['email'] = 'Ya existe un usuario con ese email.';
                        } else {
                            $contrasenaHash = password_hash($contrasena, PASSWORD_BCRYPT);
                            $sql = "INSERT INTO usuario (nombreCompleto, correoElectronico, contraseña) VALUES (:nombreCompleto, :correoElectronico, :contrasena)";
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(':nombreCompleto', $nombreCompleto);
                            $stmt->bindParam(':correoElectronico', $email);
                            $stmt->bindParam(':contrasena', $contrasenaHash);
                            $stmt->execute();
            
                            $alertMessage = '¡Registro exitoso!';
                            $_SESSION['registered'] = true;
                        }
                    } catch (PDOException $e) {
                        $errors['general'] = 'Error al registrar: ' . $e->getMessage();
                    }
                }
            }
            
            // Pasamos los errores y los valores antiguos
            echo $blade->run("registrar", ["errors" => $errors, "old" => $old, "alertMessage" => $alertMessage ?? null]);
            break;
            
        case 'inicioSesion':
            echo $blade->run("inicioSesion");
            break;

        case 'login':
            $errors = [];
            $old = [];
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING) ?? '';
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? '';
                $contrasena = filter_input(INPUT_POST, 'contrasena') ?? '';
            
                // Guardamos los valores antiguos
                $old['nombre'] = $nombre;
                $old['email'] = $email;
                $old['contrasena'] = $contrasena;
            
                // Validar nombre completo
                    if (empty($nombre)) {
                        $errors['nombre'] = 'El nombre qué utilizo en el registro es requerido.';
                    } 

                // Validar correo electrónico
                if (!$email) {
                    $errors['email'] = 'Correo electrónico inválido o vacío.';
                }
            
                // Validar contraseña
                if (empty($contrasena)) {
                    $errors['contrasena'] = 'La contraseña es requerida.';
                }
            
                // Solo proceder si no hay errores
                if (empty($errors)) {
                    try {
                        $sql = "SELECT correoElectronico, contraseña FROM usuario WHERE correoElectronico = :correoElectronico AND nombreCompleto = :nombre";
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':correoElectronico', $email);
                        $stmt->bindParam(':nombre', $nombre);
                        $stmt->execute();
                        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
                        if ($usuario) {
                            // Verificar contraseña
                            if (password_verify($contrasena, $usuario['contraseña'])) {
                                session_start();
                                $_SESSION['user_email'] = $usuario['correoElectronico'];
                                $_SESSION['user_nombre'] = $nombre;
            
                                echo "<script>window.location.href = 'index.php?view=principal';</script>";
                                exit;
                            } else {
                                $errors['contrasena'] = 'La contraseña es incorrecta.';
                            }
                        } else {
                            $errors['nombre'] = 'El nombre qué utilizo en el registro es requerido.';
                        }
                    } catch (PDOException $e) {
                        $errors['general'] = 'Error al iniciar sesión: ' . $e->getMessage();
                    }
                }
            }
            
         // Pasamos los errores y los valores antiguos
        echo $blade->run("inicioSesion", ["errors" => $errors, "old" => $old]);
        break;            
            
        case 'cesta':
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                $productId = intval($_GET['id']);
                $found = false;
                if ($productId > 0) {
                        
                    foreach ($_SESSION['cart'] as &$item) {
                        if ($item['id'] == $productId) {
                            $item['cantidad']++;
                            $found = true;
                            break;
                        }
                    }
            
                    if (!$found) {
                        $_SESSION['cart'][] = ['id' => $productId, 'cantidad' => 1];
                    }
            
                echo json_encode(['success' => true,'cart' => serialize($_SESSION['cart'])]);
                    exit();
                }
            
                 echo json_encode(['success' => false]);
                exit();
            } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['action']) && $_POST['action'] === 'remove' && isset($_POST['id'])) {
                    $id = intval($_POST['id']);
                    $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function($item) use ($id) {
                        return $item['id'] != $id;
                    }));
                    $isEmpty = empty($_SESSION['cart']);
                    echo json_encode(['success' => true, 'empty' => $isEmpty],JSON_PRETTY_PRINT);
                    exit();
                }
            
            if (isset($_POST['action']) && $_POST['action'] === 'update' && isset($_POST['id']) && isset($_POST['cantidad'])) {
                $id = intval($_POST['id']);
                $cantidad = intval($_POST['cantidad']);
                    foreach ($_SESSION['cart'] as &$item) {
                        if ($item['id'] == $id) {
                            if ($cantidad <= 0) {
                                $_SESSION['cart'] = array_filter($_SESSION['cart'], function($i) use ($id) {
                                    return $i['id'] !== $id;
                                });
                                $_SESSION['cart'] = array_values($_SESSION['cart']);
                            } else {
                                $item['cantidad'] = $cantidad;
                            }
                            break;
                        }
                    }
                    $total = 0;
                       
                    foreach ($_SESSION['cart'] as &$item) {
                        $sql = "SELECT precio FROM productos WHERE id = :id";
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':id', $item['id']);
                        $stmt->execute();
                        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
                        $total += $producto['precio'] * $item['cantidad'];
                    }
                    echo json_encode(['success' => true, 'precioTotal' => $total]);
                    exit();
                }
            } else {
                $productos = [];
                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as &$item) {
                        $sql = "SELECT id, nombre, precio FROM productos WHERE id = :id";
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':id', $item['id']);
                        $stmt->execute();
                        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
            
                        if ($producto) {
                            $producto['cantidad'] = $item['cantidad'];
                            $productos[] = $producto;
                        }
                    }
                }
            
                $total = array_reduce($productos, function($carry, $producto) {
                    return $carry + ($producto['precio'] * $producto['cantidad']);
                }, 0);
            
                echo $blade->run("cesta", ["productos" => $productos, "total" => $total]);
            }
        break;
            
        case 'recuperar-contrasenia':
            $alertMessage = '';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                        
                    if ($email) {
                        try {
                            // Verificar si el correo existe en la base de datos de usuarios
                            $sql = "SELECT COUNT(*) FROM usuario WHERE correoElectronico = :correoElectronico";
                            $stmt = $db->prepare($sql);
                            $stmt->bindParam(':correoElectronico', $email);
                            $stmt->execute();
                            $exists = $stmt->fetchColumn();
                
                            if ($exists > 0) {
                                $alertMessage = 'Se ha enviado un enlace de recuperación a tu correo.';
                            } else {
                                $alertMessage = 'No se encontró ninguna cuenta con ese correo.';
                            }
                        } catch (PDOException $e) {
                            $alertMessage = 'Error al procesar la solicitud: ' . $e->getMessage();
                        }
                    } else {
                        $alertMessage = 'Email no válido.';
                    }
                }
        echo $blade->run('recuperar-contrasenia', ['alertMessage' => $alertMessage]);
        break;         
                
        case 'cocinar': 
            $sql = "SELECT  id, nombre, categoria, descripcion, precio, imagen FROM productos WHERE categoria = 'cocinar'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo $blade->run("cocinar", ["productos" => $productos]);
            break;

        case 'utensilios':
            $sql = "SELECT  id, nombre, categoria, descripcion, precio, imagen FROM productos WHERE categoria = 'utensilios'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo $blade->run("utensilios", ["productos" => $productos]);
            break;

        case 'reposteria':
            $sql = "SELECT id, nombre, categoria, descripcion, precio, imagen FROM productos WHERE categoria = 'reposteria'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo $blade->run("reposteria", ["productos" => $productos]);
            break;
            
        case 'electrodomestico':
            $sql = "SELECT id, nombre, categoria, descripcion, precio, imagen FROM productos WHERE categoria = 'electrodomestico'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo $blade->run("electrodomestico", ["productos" => $productos]);
            break;

        // Lógica para 'finalizarCompra'
        case 'finalizarCompra':
            $mensajeConfirmacion = '';
            $productos = [];

            // Inicializar variables del cliente vacías para evitar errores
            $nombreCompleto = '';
            $email = '';
            $direccion = '';
            $numeroTarjeta = '';
            
            // Obtener los productos del carrito de la sesión
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as &$item) {
                    $sql = "SELECT id, nombre, precio FROM productos WHERE id = :id";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':id', $item['id']);
                    $stmt->execute();
                    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($producto) {
                        $producto['cantidad'] = $item['cantidad'];
                        $productos[] = $producto;
                    }
                }
            }

            // Si se recibe una solicitud POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Obtener los datos del cliente
                $nombreCompleto = filter_input(INPUT_POST, 'nombre') ?? '';
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) ?? '';
                $direccion = filter_input(INPUT_POST, 'direccion') ?? '';
                $numeroTarjeta = filter_input(INPUT_POST, 'numero_tarjeta') ?? '';

                // Validar los campos
                if (!empty($nombreCompleto) && $email && !empty($direccion) && !empty($numeroTarjeta) && esNumeroTarjetaValido(str_replace(' ', '', $numeroTarjeta))) {
                    $mensajeConfirmacion = "¡Compra realizada con éxito!<br>Gracias por comprar en <b>El Rinconcito de Julito</b>.";
                    $_SESSION['cart'] = []; // Limpiar el carrito después de procesar la compra
                } else {
                    $mensajeConfirmacion = 'Por favor, completa todos los campos correctamente.';
                }
            }

            // Calcular el total de la compra
            $total = array_reduce($productos, function($carry, $producto) {
                return $carry + ($producto['precio'] * $producto['cantidad']);
            }, 0);

            // Renderizar la vista de finalizar compra
            echo $blade->run("finalizarCompra", [
                "productos" => $productos,
                "total" => $total,
                "mensajeConfirmacion" => $mensajeConfirmacion,
                "nombreCompleto" => $nombreCompleto,
                "email" => $email,
                "direccion" => $direccion,
                "numeroTarjeta" => $numeroTarjeta
            ]);
            break;

        case 'receta_detallada':
                // Verificar si el ID está presente y es válido
                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                    if ($id === false || $id <= 0) {
                        die('ID de receta no válido.');
                    }
            
                    // Aquí conectas a tu base de datos y buscas la receta por el id
                    $sql = "SELECT * FROM recetas WHERE id = :id";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $receta = $stmt->fetch(PDO::FETCH_ASSOC);
            
                    if (!$receta) {
                        die('Receta no encontrada con el ID: ' . htmlspecialchars($id));
                    }

                    // Aquí se separan los ingredientes e instrucciones
                    if (!empty($receta['ingredientes'])) {
                        $receta['ingredientes'] = explode(",", $receta['ingredientes']);
                    } else {
                        $receta['ingredientes'] = []; // Si no hay ingredientes, asigna un array vacío
                    }

                    if (!empty($receta['instrucciones'])) {
                        $receta['instrucciones'] = explode("\n", $receta['instrucciones']);
                    } else {
                        $receta['instrucciones'] = []; // Si no hay instrucciones, asigna un array vacío
                    }
            
                    // Pasa la receta a la vista
                    echo $blade->run("receta_detallada", ["receta" => $receta, "pais" => $receta['pais']]);
                    exit;
                } else {
                    die('ID de receta no presente.');
                }

        case 'producto_detallado':
            $nombre = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_STRING);
            
            // Realiza una consulta a la base de datos para obtener el producto
            $sql = "SELECT * FROM productos WHERE nombre = :nombre";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // Verifica si se encontró el producto
            if ($producto) {
                // Procesar imágenes si están en un campo de la base de datos
                $imagenes = explode(',', $producto['imagenes']); // Suponiendo que son múltiples
                echo $blade->run("producto_detallado", ["producto" => $producto, "imagenes" => $imagenes]);
            } else {
                // Manejar el caso en que no se encuentra el producto
                echo "Producto no encontrado.";
            }
            break;
        
        default:
            $sql = "SELECT DISTINCT paisOrigen FROM recetas";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $paises = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo $blade->run("principal", ["paises" => $paises, "alertMessage" => $alertMessage ?? '']);
            break;
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
?>










                                        


                                                      




