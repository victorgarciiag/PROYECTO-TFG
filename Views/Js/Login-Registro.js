//MOVIMIENTOS DE LOS BOTONES LOGIN Y REGISTRO
const botonIniciarSesion = document.getElementById("inicio-sesion"),
  botonRegistrarse = document.getElementById("registro"),
  contenedorFormularioRegistro = document.querySelector(".register"),
  contenedorFormularioInicioSesion = document.querySelector(".login");

botonIniciarSesion.addEventListener("click", (e) => {
  contenedorFormularioRegistro.classList.add("hide");
  contenedorFormularioInicioSesion.classList.remove("hide");
});

botonRegistrarse.addEventListener("click", (e) => {
  contenedorFormularioInicioSesion.classList.add("hide");
  contenedorFormularioRegistro.remove("hide");
});

//COMPROBACIÓN DE CAMPS VACIOS EN EL LOGIN:
document.addEventListener("DOMContentLoaded", function () {
  const formulario = document.getElementById("login");

  formulario.addEventListener("submit", function (event) {
    // Evita que el formulario se envíe de forma predeterminada
    event.preventDefault();

    const usuario = formulario.elements["usuario"].value.trim();
    const password = formulario.elements["password"].value.trim();

    // Verificamos si los campos estan vacios, de ser asi muestra un error.
    if (usuario === "" || password === "") {
      document.getElementById("mensaje-error").innerText =
        "Por favor, ingrese usuario y contraseña.";
    } else {
      // Si los campos no están vacíos, envía el formulario
      formulario.submit();
    }
  });
});
