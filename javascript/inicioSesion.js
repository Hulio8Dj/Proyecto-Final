document.getElementById("loginForm").addEventListener("submit", function (event) {
    let hasError = false;

    // Validar nombre completo
    const nombre = document.getElementById("nombre");
    if (nombre.value.trim() === "") {
      nombre.classList.add("is-invalid");
      if (!document.querySelector("#nombre + .invalid-feedback")) {
        let errorDiv = document.createElement("div");
        errorDiv.classList.add("invalid-feedback");
        errorDiv.textContent = "El nombre completo es requerido.";
        nombre.insertAdjacentElement("afterend", errorDiv);
      }
      hasError = true;
    } else {
      nombre.classList.remove("is-invalid");
    }

    // Validar correo electrónico
    const email = document.getElementById("email");
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email.value.trim())) {
      email.classList.add("is-invalid");
      if (!document.querySelector("#email + .invalid-feedback")) {
        let errorDiv = document.createElement("div");
        errorDiv.classList.add("invalid-feedback");
        errorDiv.textContent = "Correo electrónico inválido.";
        email.insertAdjacentElement("afterend", errorDiv);
      }
      hasError = true;
    } else {
      email.classList.remove("is-invalid");
    }

    // Validar contraseña
    const contrasena = document.getElementById("contrasena");
    if (contrasena.value.trim() === "") {
      contrasena.classList.add("is-invalid");
      if (!document.querySelector("#contrasena + .invalid-feedback")) {
        let errorDiv = document.createElement("div");
        errorDiv.classList.add("invalid-feedback");
        errorDiv.textContent = "La contraseña es requerida."; // Asegúrate de que este mensaje sea claro
        contrasena.insertAdjacentElement("afterend", errorDiv);
      }
      hasError = true;
    } else {
      contrasena.classList.remove("is-invalid");
    }

    if (hasError) {
      event.preventDefault(); // Evita el envío del formulario si hay errores
    }
  });
