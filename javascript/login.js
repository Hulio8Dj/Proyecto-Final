function validarYRedirigir() {
  const nombre = document.getElementById("nombre").value;
  const email = document.getElementById("email").value;
  const contrasena = document.getElementById("contrasena").value;

  if (nombre.trim() === "" || email.trim() === "" || contrasena.trim() === "") {
    alert("Por favor, completa todos los campos del formulario.");
  } else {
    window.location.href = "/index.php"; // Redirige a la página principal
  }
}

function validarFormulario() {
  const email = document.getElementById("email").value;
  const contrasena = document.getElementById("contrasena").value;

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const contrasenaRegex =
    /^(?=.*[A-Z])(?=.*[!@#$%^&*?])[A-Za-z\d!@#$%^&*?]{8,}$/;

  if (!emailRegex.test(email)) {
    alert("Por favor, introduce un email válido.");
    return false;
  }

  if (!contrasenaRegex.test(contrasena)) {
    alert(
      "La contraseña debe tener al menos 8 caracteres, una mayúscula y un carácter especial."
    );
    return false;
  }

  return true;
}
