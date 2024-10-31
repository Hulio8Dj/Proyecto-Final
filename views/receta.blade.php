<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $receta['nombre'] }} - El Rinconcito de Julito</title>
        <link rel="stylesheet" href="src/Css/style.css">
        <script src="src/javascript/receta.js"></script> 
    </head>
    <body>
        <header> 
            <div class="logo"><a href="index.php">El Rinconcito de Julito</a></div>
        </header>
        <main>
            <section class="recipe-detail">
                <h1>{{ $receta['nombre'] }}</h1>
                <p><strong>Tiempo de Preparación:</strong> {{ $receta['tiempoPreparacion'] }} minutos</p>
                <p><strong>Dificultad:</strong> {{ $receta['dificultad'] }}</p>
                <p><strong>Ingredientes:</strong> {{ $receta['ingredientes'] }}</p>
                <p><strong>Instrucciones:</strong> {{ $receta['instrucciones'] }}</p>
                <p><strong>Imagenes:</strong> {{ $receta['imagen'] }}</p>
            </section>
        </main>
        <footer>
            <div class="footer-content">
                <p class="footer-description">
                    <b>El Rinconcito de Julito</b><br> Blog de cocina donde encontrarás recetas deliciosas y utensilios para hacer tu cocina más divertida.<br>
                    Síguenos en nuestras redes sociales o apúntate a nuestra Newsletter<br> 
                    donde recibirás nuestras recetas, ofertas y todas las novedades.
                </p>
                <div class="footer-social">
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
                    <form action="#" method="post">
                        <input type="email" name="email" placeholder="Introduce tu email" required>
                        <button type="submit">Suscribirse</button>
                    </form>
                </div>
            </div>
        </footer>
    </body>
</html>

