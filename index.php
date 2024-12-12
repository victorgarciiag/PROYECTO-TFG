<?php
$controla = false;
include('./models/config.php');
include('./models/lib.php');

$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);
// Obtener todas las noticias
$query = "SELECT * FROM noticias ORDER BY id DESC";  // Asumiendo que 'id' es el identificador único
$result = mysqli_query($conexion, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <title>Proyecto TFG</title>
    <link rel="stylesheet" href="./views/css/index.css">
    <link rel="icon" href="./Public/Img/logo2.jpg" type="image/png">

</head>

<body>
    <nav>
        <div class="logo">
            <img src="./public/img/logo.jpg">
            <a href="index.php">ConcesionarioKTM</a>
        </div>
        <div class="menu-container">
            <ul id="nav-menu">
                <li><a href="./views/PHP/accesorios.php">Accesorios</a></li>
                <li><a href="./views/PHP/concesionarios.php">Concesionarios</a></li>
                <li><a href="./views/html/ayuda.html">Ayuda</a></li>
            </ul>
        </div>
        <a href="./views/PHP/login.php"><button>¡Pide tu cita!</button></a>
        <a href="./views/PHP/area_personal.php"><button>Area del Personal</button></a>
        <button id="menuButton" onclick="toggleMenu()">
            <i class='bx bx-menu'></i>
        </button>
    </nav>

    <div class="main" id="main">
        <div class="izquierda">
            <h1>2024 KTM 450 EXC-F</h1>
            <h3>ÚLTIMA NOVEDAD SOBRE EL OFFROAD DE <span>KTM</span></h3>
            <p>
                La KTM 450 EXC-F 2024 llega a la categoría open con un renovado hambre por encontrar el límite. Con un nuevo chasis, suspensiones, carrocería probada en competición y una ergonomía centrada en el piloto, por no mencionar uno de los motores de 450 cc más victoriosos de la categoría, la KTM 450 EXC-F está lista para salir siempre con la vista puesta en el podio.
            </p>
        </div>

        <!--CARRUSEL IMAGENES MOTO 2024 -->

        <div class="carrusel-container">
            <div class="derecha">
                <img src="./public/IMG/carrusel2.jpeg" class="imagen-carrusel">
                <div class="arrow left"><i class="bx bx-chevron-left"></i></div>
                <div class="arrow right"><i class="bx bx-chevron-right"></i></div>
            </div>
        </div>
    </div>


    <div class="read-to-race" id="read-to-race">
        <div class="carrusel2">
            <img src="./public/IMG/dakar.jpeg" class="imagen-carrusel2">
            <div class="texto-encima">
                <h1>READY TO RACE</h1>
                <div class="boton-ourWorld">
                    <a href="./views/HTML/UltimasNoticias.html">ÚLTIMAS NOTICIAS</a>
                </div>
            </div>
        </div>
    </div>

    <div class="noticias">
        <div class="header">
            <div class="info">
                <h2>CURIOSIDADES SOBRE EL EQUIPO KTM FACTORY RACING:</h2>
            </div>
        </div>

        <div class="diferentes-noticias">
            <?php
            // Consultar todas las noticias
            $result = mysqli_query($conexion, "SELECT * FROM noticias");

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="item">
                    <img src="views/php/uploads/<?php echo basename($row['imagen']); ?>" alt="Imagen noticia">
                    <div class="info">
                        <h3><?php echo $row['titulo']; ?></h3>
                        <p><?php echo $row['descripcion']; ?></p>
                        <a href="<?php echo $row['link_video']; ?>" target="_blank">Ver en Youtube <i class='bx bx-link-external'></i></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div id="cookie-banner" style="position: fixed; bottom: 0; left: 0; width: 100%; background: #333; color: white; padding: 10px; text-align: center;">
        <p>Este sitio web utiliza cookies para mejorar la experiencia del usuario. Al continuar navegando, aceptas su uso.
            <a href="#" style="color: #FF6600;" onclick="acceptCookies()">Aceptar</a> |
            <a href="./views/html/cookies.html" style="color: #1E90FF;">Leer más</a>
        </p>
    </div>


    </div>

    <div class="reseñas" id="reseñas">
        <h1>Reseñas clientes:</h1>
        <div class="customers">
            <div class="item">
                <div class="estrellas">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                </div>
                <p>
                    ¡Increíble experiencia en este concesionario de motos! Desde el momento en que entré, el personal fue extremadamente amable y servicial.Me guiaron a través de todo el proceso de compra de mi nueva moto, asegurándose de que encontrara la mejor opción.
                </p>
                <div class="user">
                    <img src="./public/img/persona1.avif">
                    <div class="info">
                        <h5>Francisco de Asis</h5>
                        <p>Cliente VIP</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="estrellas">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                </div>
                <p>
                    ¡No puedo estar más satisfecho con mi experiencia en este concesionario de motos! La selección de motocicletas era impresionante y el personal estaba muy bien informado y dispuesto a responder a todas mis preguntas.
                </p>
                <div class="user">
                    <img src="./public/img/persona2.jpg">
                    <div class="info">
                        <h5>Lucas Moreno</h5>
                        <p>Cliente VIP</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="estrellas">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                </div>
                <p>
                    Desde el momento en que entré en este concesionario, supe que había encontrado el lugar adecuado para comprar mi nueva moto. El ambiente era acogedor y el personal era extremadamente atento y profesional.
                </p>
                <div class="user">
                    <img src="./public/img/persona3.jpg">
                    <div class="info">
                        <h5>Javier Calderon</h5>
                        <p>Cliente VIP</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer>
        <div class="top">
            <div class="logo">
                <img src="./public/img/logo2.jpg">
                <a href="index.php">ConcesionarioKTM</a>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="./views/PHP/accesorios.php">Accesorios</a></li>
                <li><a href="./views/php/concesionarios.php">Concesionarios</a></li>
                <li><a href="./views/html/ayuda.html">Ayuda</a></li>
            </ul>
            <div class="rrss-links"><!--Clases predefinidas para logos de rrss.-->
                <a href="https://www.facebook.com/Official.KTM/?locale=es_ES" target="_blank"><i class='bx bxl-facebook'></i></a>
                <a href="https://www.instagram.com/ktm_official/" target="_blank"><i class='bx bxl-instagram'></i></a>
                <a href="https://twitter.com/KTM_Racing" target="_blank"><i class='bx bxl-twitter'></i></a>
                <a href="https://www.linkedin.com/company/ktm-group/?originalSubdomain=es"><i class='bx bxl-linkedin-square' target="_blank"></i></a>
            </div>
        </div>
        <div class="separator"></div>
        <div class="bottom">
            <p>
                Hecha por Victor García.
            </p>
            <div class="links">
                <a href="./views/html/politicaYprivacidad.html">Política y Privacidad</a>
                <a href="./views/html/terminosYcondiciones.html">Terminos y Condiciones</a>
                <a href="./views/html/cookies.html">Cookies</a>
            </div>
        </div>
    </footer>

    <script>
        function acceptCookies() {
            // Establecer la cookie para indicar que el usuario ha aceptado las cookies
            document.cookie = "cookieConsent=true; max-age=" + 60 * 60 * 24 * 365 + "; path=/";

            // Ocultar el banner de cookies
            document.getElementById('cookie-banner').style.display = 'none';
        }
    </script>
    <script src="./views/js/carrusel.js"> </script>

</body>

</html>