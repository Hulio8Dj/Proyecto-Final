function mostrarError(mensaje) {
  const alertMessage = document.getElementById("alert-message");
  alertMessage.style.display = "block";
  alertMessage.innerText = mensaje;
}

function eliminarArticulo(id) {
  console.log(`Eliminando artículo con ID ${id}`);
  fetch("index.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: "remove",
      id: id,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((data) => {
      console.log("Respuesta al eliminar artículo:", data);
      if (data.success) {
        const fila = document.querySelector(`tr[data-producto-id="${id}"]`);
        if (fila) {
          fila.remove();
        }
        if (data.empty) {
          document.querySelector(".container").innerHTML = `
                    <div class="alert alert-info">
                        <h1>Tu cesta "El Rinconcito de Julito" está vacía.</h1>
                        <p>No hay productos en tu cesta.</p>
                        <a href="index.php?view=principal" class="btn btn-primary">Volver a la página principal</a>
                        </div>
                        <div class="text-center mt-4">
                            <img src="/src/Imagenes/caraTriste.jpeg" alt="Imagen de la cesta" class="img-cesta">
                        </div>`;
        } else {
          actualizarTotalCesta();
        }
      } else {
        console.error("Error al eliminar el artículo", data);
        mostrarError("No se pudo eliminar el artículo.");
      }
    })
    .catch((error) => {
      console.error("Error en la solicitud:", error);
      mostrarError("Hubo un problema con la solicitud.");
    });
}

function actualizarCantidad(id, cambio) {
  const cantidadElemento = document.querySelector(`#cantidad-${id} span`);
  const cantidadActual = parseInt(cantidadElemento.textContent.trim());
  const nuevaCantidad = cantidadActual + cambio;

  if (nuevaCantidad >= 0) {
    fetch("index.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        action: "update",
        id: id,
        cantidad: nuevaCantidad,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          console.log("Total del carrito:", data.precioTotal);
          console.log("Total del carrito:", data.cart);
          cantidadElemento.textContent = nuevaCantidad;
          document.querySelector(
            `#total-${id}`
          ).textContent = `€${data.precioTotal.toFixed(2)}`;
          actualizarTotalCesta();
        } else {
          console.log("Error al actualizar la cantidad");
          mostrarError("No se pudo actualizar la cantidad.");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        mostrarError("Hubo un problema con la solicitud.");
      });
  }
}

function actualizarTotalCesta() {
  const filas = document.querySelectorAll("#cesta-table tbody tr");
  let total = 0;
  filas.forEach((fila) => {
    const cantidad = parseInt(
      fila
        .querySelector(`#cantidad-${fila.dataset.productoId} span`)
        .textContent.trim()
    );
    const precio = parseFloat(fila.children[1].textContent.replace("€", ""));
    const totalFila = cantidad * precio;
    fila.querySelector(
      `#total-${fila.dataset.productoId}`
    ).textContent = `€${totalFila.toFixed(2)}`;
    total += totalFila;
  });
  document.getElementById("total-cesta").textContent = `Total: €${total.toFixed(
    2
  )}`;
}
