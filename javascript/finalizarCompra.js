// Función para formatear el número de tarjeta mientras se escribe
function formatearTarjeta(input) {
  let numero = input.value.replace(/\D/g, ""); // Eliminar cualquier carácter que no sea dígito
  if (numero.length > 16) {
    numero = numero.slice(0, 16); // Limitar a 16 dígitos
  }
  // Agregar un espacio después de cada 4 dígitos
  input.value = numero.replace(/(.{4})/g, "$1 ").trim();
}
