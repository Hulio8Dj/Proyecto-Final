# "El Rinconcito de Julito"

## Descripción

"El Rinconcito de Julito" es un blog de cocina que proporciona recetas de diversas culturas, utensilios de cocina, y productos relacionados con la gastronomía. El sitio web permite a los usuarios explorar recetas por país, buscar productos, y suscribirse a una newsletter para recibir actualizaciones y ofertas. Además, los usuarios pueden **comprar cualquier utensilio o electrodoméstico** disponible en nuestro catálogo, facilitando así que equipen su cocina con lo mejor.

## Tecnologías Utilizadas

- **HTML**: Estructura de las páginas web.
- **CSS**: Estilización de la apariencia de las páginas.
- **JavaScript**: Interactividad del sitio web.
- **Bootstrap**: Framework de CSS para un diseño receptivo y elegante.
- **PHP**: Lenguaje del lado del servidor utilizado para manejar la lógica y la conexión con la base de datos.

## Instalación

1. **Clonar el repositorio**

   ```bash
   git clone https://github.com/Redondo87/TFG/risas-sabores.git
   
2. **Instalar dependencias**

   ```bash
   cd risas-sabores
   cd .env.example .env

3. **Configuración del servidor**

   Configurar el servidor web para servir el contenido del directorio del proyecto. Si estás utilizando Apache, asegúrate de que el archivo .htaccess esté correctamente configurado para manejar las rutas.

4. **Base de datos**

   Se ha creado una base de datos RISASYSABORES en el servidor MySQL, para crear mas tablas se deberá ejecutar las migraciones.

5. **Iniciar el servidor**

   Usa el siguiente comando para iniciar un servidor de desarrollo PHP.

   php -S localhost:8000

   Luego, abre tu navegador y navega a http://localhost:8000.

## Estructura del Proyecto

·  /src/Css: Archivos CSS para la estilización del sitio.

·  /src/imagenes: Imágenes utilizadas en el sitio.

·  /src/Imagenes/fotosBanderas: Imágenes de banderas de países.

·  /src/Imagenes/fotosProductos: Imágenes de productos.

·  /src/Imagenes: Imágenes generales del sitio.

·  /index.php: Archivo principal que maneja las rutas y vistas del sitio.

## Características

·  Página Principal: Muestra enlaces a recetas de diferentes países.

·  Recetas por País: Permite a los usuarios ver recetas basadas en el país seleccionado.

·  Buscador: Permite a los usuarios buscar productos y recetas.

·  Cesta de Compras: Muestra los productos añadidos a la cesta.

·  Newsletter: Permite a los usuarios suscribirse para recibir actualizaciones.

## Uso

·  Navegar por recetas: En la página principal, selecciona una receta para ver más detalles.

·  Buscar productos: Usa el buscador para encontrar productos específicos.

·  Gestionar cesta: Añade productos a la cesta desde la página de productos.

·  Suscribirse a la Newsletter: Introduce tu email en el formulario de suscripción en el pie de página.

## Contacto

·  Para cualquier consulta, puedes contactar a *jaragonesbernal@gmail.com*.

