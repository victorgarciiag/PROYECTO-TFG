// CARRUSEL 1:

// ARRAY DE LAS IMAGENES
const imag = [
  "./public/img/carrusel1.png",
  "./public/img/carrusel2.png",
  "./public/img/carrusel3.png",
  "./public/img/carrusel4.png",
];

let cont = 0;

// FUNCIONES
const mostrarImagen = () => {
  const imagen = document.querySelector(".derecha .imagen-carrusel");
  imagen.src = imag[cont]; // Actualiza la imagen en el carrusel con la correspondiente del array
};

const siguienteImagen = () => {
  cont++;
  if (cont >= imag.length) {
    cont = 0;
  }
  ocultarImagen(mostrarImagen);
};

const anteriorImagen = () => {
  cont--;
  if (cont < 0) {
    cont = imag.length - 1;
  }
  ocultarImagen(mostrarImagen);
};

const ocultarImagen = (callback) => {
  const imagen = document.querySelector(".derecha .imagen-carrusel");
  imagen.classList.add("oculto");
  setTimeout(() => {
    imagen.classList.remove("oculto");
    callback(); // Se llama a la función mostrarImagen
  }, 500); // Tiempo de espera, debe ser igual al tiempo de animación definido en CSS
};

// Mostrar imagen inicial
mostrarImagen();

// ADDEVENTLISTENERS para el primer carrusel
const flechaDerecha = document.querySelector(".derecha .arrow.right");
flechaDerecha.addEventListener("click", siguienteImagen);

const flechaIzquierda = document.querySelector(".derecha .arrow.left");
flechaIzquierda.addEventListener("click", anteriorImagen);

// Función para gestionar el menú en dispositivos móviles
function toggleMenu() {
  const menu = document.querySelector(".menu-container");
  menu.classList.toggle("active"); // Alterna la clase 'active' en el contenedor del menú
}
