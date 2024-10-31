document.addEventListener("DOMContentLoaded", function () {
  // Obtener el ID del producto desde la URL
  const urlParams = new URLSearchParams(window.location.search);
  const productoId = urlParams.get("id"); // Obtener el ID del producto

  // Log para depuración
  console.log("Producto ID:", productoId);

  // Si el ID existe, desplazar suavemente hacia él
  if (productoId) {
    const productoElement = document.getElementById(`producto-${productoId}`);

    // Log para depuración
    console.log("Elemento encontrado:", productoElement);

    // Si el elemento existe, desplazar suavemente hacia él
    if (productoElement) {
      setTimeout(() => {
        productoElement.scrollIntoView({ behavior: "smooth" });
        console.log("Desplazando hacia el producto:", productoElement); // Log de desplazamiento
      }, 100); // Retardo para asegurarse de que el DOM esté completamente cargado
    } else {
      console.error("Elemento no encontrado:", `#producto-${productoId}`);
    }
  } else {
    console.error("ID del producto no encontrado en la URL.");
  }
});
