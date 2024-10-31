function searchAction() {
  window.location.href = "/views/buscador.blade.php?q=consulta";
}

function checkFormAndRedirect() {
  const nombre = document.getElementById("nombre").value.trim();
  const email = document.getElementById("email").value.trim();
  const contrasena = document.getElementById("contrasena").value.trim();

  if (nombre === "" || email === "" || contrasena === "") {
    alert(
      "Debes completar todos los campos del registro antes de iniciar sesión."
    );
    return false; // Evitar redirección
  } else {
    window.location.href = "/index.php?view=principal";
    return false; // No permitir redirección automática desde el botón
  }
}

document
  .getElementById("loginButton")
  .addEventListener("click", function (event) {
    if (!checkFormAndRedirect()) {
      event.preventDefault(); // Prevenir redirección si los campos están vacíos
    }
  });

function validarFormulario() {
  const email = document.getElementById("email").value.trim();
  const contrasena = document.getElementById("contrasena").value.trim();

  if (email === "" || contrasena === "") {
    alert("Por favor, complete todos los campos.");
    return false;
  }
  // Eliminar o comentar la siguiente línea si no es necesario mostrar el mensaje en la consola
  // console.log('Contraseña válida');
  return true;
}

function redirectToLogin() {
  window.location.href = "/index.php?view=inicioSesion";
}
