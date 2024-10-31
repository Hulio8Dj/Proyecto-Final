document.addEventListener("DOMContentLoaded", function () {
  var despegablebusqueda = document.getElementById("despegable-busqueda");
  var closeButton = document.getElementById("closeButton");
  var sideMenu = document.getElementById("sideMenu");

  despegablebusqueda.addEventListener("click", function () {
    sideMenu.classList.add("open");
  });

  closeButton.addEventListener("click", function () {
    sideMenu.classList.remove("open");
  });
});

function buscarProductos(query) {
  var resultadosContainer = document.getElementById(
    "resultados-autocompletado"
  );
  resultadosContainer.innerHTML = ""; // Limpiar resultados anteriores

  fetch("index.php?view=buscar_productos_ajax&q=" + encodeURIComponent(query))
    .then((response) => response.json())
    .then((data) => {
      data.forEach((item) => {
        var li = document.createElement("li");
        li.classList.add("search-result-item");

        var contenido = `
           
                <div class="result-item-content">
                    
                    <div class="result-item-info">
                        <h4>${item.nombre}</h4>
                        <img src="/src/Imagenes/fotosProductos/${item.imagen}" alt="${item.nombre}" class="result-item-image">
                        <p>${item.descripcion}</p>
                        <p>Precio: ${item.precio} €</p>
                        <a href="index.php?view=${item.categoria}" class="categoria-link">Categoría ${item.categoria}</a>
                    </div>
                </div>
            `;
        li.innerHTML = contenido;
        resultadosContainer.appendChild(li);
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function addToCart(productId) {
  fetch("index.php?view=cesta&id=" + encodeURIComponent(productId))
    .then((response) => response.json())
    .then((data) => {
      const cartMessage = document.getElementById("cart-message");
      if (data.success) {
        cartMessage.textContent = data.message;
        cartMessage.classList.add("alert-success");
        cartMessage.classList.remove("alert-danger");
      } else {
        cartMessage.textContent = data.message;
        cartMessage.classList.add("alert-danger");
        cartMessage.classList.remove("alert-success");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      const cartMessage = document.getElementById("cart-message");
      cartMessage.textContent = "Error al añadir el producto.";
      cartMessage.classList.add("alert-danger");
      cartMessage.classList.remove("alert-success");
    });
}

document.addEventListener("DOMContentLoaded", function () {
  const dropdownToggle = document.getElementById("dropdownUserMenu");
  const dropdownMenu = dropdownToggle.nextElementSibling;

  dropdownToggle.addEventListener("click", function (event) {
    event.stopPropagation(); // Evitar que el clic se propague y cierre el menú inmediatamente
    dropdownMenu.classList.toggle("show"); // Alternar clase 'show' para mostrar/ocultar
  });

  // Cerrar el menú al hacer clic fuera
  document.addEventListener("click", function (event) {
    if (
      !dropdownToggle.contains(event.target) &&
      !dropdownMenu.contains(event.target)
    ) {
      dropdownMenu.classList.remove("show"); // Remover clase 'show' al hacer clic fuera
    }
  });
});

// Esperar a que el contenido del DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
  // Obtener elementos del DOM
  var despegableBusqueda = document.getElementById("despegable-busqueda");
  var searchContainer = document.getElementById("searchContainer");

  // Agregar un evento de clic al div que muestra/oculta el buscador
  despegableBusqueda.addEventListener("click", function () {
    if (
      searchContainer.style.display === "none" ||
      searchContainer.style.display === ""
    ) {
      searchContainer.style.display = "block"; // Muestra el buscador
    } else {
      searchContainer.style.display = "none"; // Oculta el buscador
    }
  });
});
