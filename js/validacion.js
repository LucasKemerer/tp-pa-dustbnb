// Se recuperan los input y el boton del formulario
const inputUsuario = document.getElementById("usuario");
const inputContrasena = document.getElementById("contrasena");
const inputCaptcha = document.getElementById("captcha");
const btnIngresar = document.getElementById("btnIngresar");

// Se comprueba que los input no esten vacios o unicamente con espacios en blanco
function validarDatos() {
  const valorUsuario = inputUsuario.value.trim();
  const valorContrasena = inputContrasena.value.trim();
  const valorCaptcha = inputCaptcha.value.trim();

  if (valorUsuario !== "" && valorContrasena !== "" && valorCaptcha !== "")
    btnIngresar.disabled = false;
  else btnIngresar.disabled = true;
}

// Se agregan los escuchadores para detectar cambios en los input
inputUsuario?.addEventListener("input", validarDatos);
inputContrasena?.addEventListener("input", validarDatos);
inputCaptcha?.addEventListener("input", validarDatos);

const inputNombre = document.getElementById("nombre");
const inputDireccion = document.getElementById("direccion");
const inputCapacidad = document.getElementById("capacidad");
const inputPrecio = document.getElementById("precio");
const btnGuardar = document.getElementById("btnGuardar");

function validarDepartamento() {
  const valorNombre = inputNombre.value.trim();
  const valorDireccion = inputDireccion.value.trim();
  const valorCapacidad = Number(inputCapacidad.value);
  const valorPrecio = Number(inputPrecio.value);

  if (valorNombre !== "" && valorDireccion !== "" && Number.isInteger(valorCapacidad) && valorCapacidad >= 1 && valorPrecio > 0)
    btnGuardar.disabled = false;
  else btnGuardar.disabled = true;
}

inputNombre?.addEventListener("input", validarDepartamento);
inputDireccion?.addEventListener("input", validarDepartamento);
inputCapacidad?.addEventListener("input", validarDepartamento);
inputPrecio?.addEventListener("input", validarDepartamento);

if (inputNombre) validarDepartamento();

document.querySelectorAll(".form-baja").forEach((formulario) => {
  formulario.addEventListener("submit", (evento) => {
    if (!confirm("¿Seguro que querés eliminar este departamento?")) evento.preventDefault();
  });
});

if (document.getElementById("tablaDepartamentos")) {
  new DataTable("#tablaDepartamentos", {
    language: { url: "https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json" },
    columnDefs: [{ orderable: false, searchable: false, targets: -1 }],
  });
}
