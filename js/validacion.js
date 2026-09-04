// Se recuperan los input y el boton del formulario
const inputUsuario = document.getElementById("usuario");
const inputContrasena = document.getElementById("contrasena");
const btnIngresar = document.getElementById("btnIngresar");

// Se comprueba que los input no esten vacios o unicamente con espacios en blanco
function validarDatos() {
  const valorUsuario = inputUsuario.value.trim();
  const valorContrasena = inputContrasena.value.trim();

  if (valorUsuario !== "" && valorContrasena !== "")
    btnIngresar.disabled = false;
  else btnIngresar.disabled = true;
}

// Se agregan los escuchadores para detectar cambios en los input
inputUsuario.addEventListener("input", validarDatos);
inputContrasena.addEventListener("input", validarDatos);
