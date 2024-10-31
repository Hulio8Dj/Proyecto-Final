document.addEventListener("DOMContentLoaded", function () {
  const addToCartButtons = document.querySelectorAll(".add-to-cart");

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const id = this.getAttribute("data-id");
      const cardBody = this.closest(".card-body");
      const alertMessage = cardBody.querySelector(".alert-message");

      console.log("ID del producto:", id); // Depuración

      if (id) {
        fetch(`index.php?view=cesta&id=${id}`)
          .then((response) => response.json())
          .then((data) => {
            console.log("Respuesta del servidor:", data); // Depuración
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
