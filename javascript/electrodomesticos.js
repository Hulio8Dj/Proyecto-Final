document.addEventListener("DOMContentLoaded", function () {
  const addToCartButtons = document.querySelectorAll(".add-to-cart");

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      // Prevenir que el clic en el botón cierre el modal
      event.stopPropagation();

      const id = this.getAttribute("data-id");
      const nombre = this.getAttribute("data-nombre");
      const precio = this.getAttribute("data-precio");
      const alertMessage =
        this.closest(".card-body").querySelector(".alert-message");

      if (id) {
        // Hacer la solicitud al servidor para agregar el producto a la cesta
        fetch(`index.php?view=cesta&id=${id}`)
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              alertMessage.textContent = "Producto agregado a la cesta";
              alertMessage.style.color = "green";
            } else {
              alertMessage.textContent = "Error al agregar el producto";
              alertMessage.style.color = "red";
            }
            alertMessage.style.display = "block";
          })
          .catch((error) => {
            alertMessage.textContent = "Error al agregar el producto";
            alertMessage.style.color = "red";
            alertMessage.style.display = "block";
            console.error("Error:", error);
          });
      } else {
        console.error("No product ID found");
      }
    });
  });

  // Evento para mostrar el modal con la información del producto
  const productCards = document.querySelectorAll(".card");

  productCards.forEach((card) => {
    card.addEventListener("click", function () {
      const nombre = this.getAttribute("data-nombre");
      const descripcion = this.getAttribute("data-descripcion");
      const precio = this.getAttribute("data-precio");

      // Actualizar contenido del modal
      document.getElementById("modalProductName").textContent = nombre;
      document.getElementById("modalProductDescription").textContent =
        descripcion;
      document.getElementById("modalProductPrice").textContent = `€ ${precio}`;
    });
  });
});
