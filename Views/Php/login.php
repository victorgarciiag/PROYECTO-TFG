<?php
$controla = false;
include('../../models/config.php');
include('../../models/lib.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../views/css/Login_styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="../../Public/Img/logo2.jpg" type="image/png">
    <title>Login</title>
</head>

<body>
    <header>
        <a href="../../index.php"><img src="../../public/img/logo3.webp" alt="Logo"></a>
    </header>

    <div class="contenido-formu register">
        <div class="info">
            <div class="info-2">
                <h2>Bienvenido</h2>
                <p>¡Inicia sesión y vive la emoción sobre dos ruedas!</p>
                <input type="button" value="Iniciar Sesión" id="inicio-sesion"><!--Boton que se mueve a la pestaña de inicio de sesion.-->
            </div>
        </div>

        <!--REGISTRO: -->
        <div class="info-formulario">
            <div class="info-formulario-2">
                <h2>Crear una Cuenta</h2>

                <form class="form form-registro" action="../../controllers/control_registro.php" method="post">
                    <div>
                        <label>
                            <i class='bx bx-name'></i>
                            <input type="text" placeholder="Nombre completo" name="nombre">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-user'></i>
                            <input type="text" placeholder="Nombre Usuario" name="usuario">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" placeholder="Contraseña" name="password">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-envelope'></i>
                            <input type="email" placeholder="Correo Electronico" name="email">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-phone'></i>
                            <input type="tel" placeholder="Teléfono" name="telefono">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-date'></i>
                            <input type="date" placeholder="Fecha Nacimiento" name="fechaNacimiento">
                        </label>
                    </div>


                    <input type="submit" value="Registrarse">
                    <div id="mensaje">
                        <?php
                        // Verificar si el mensaje está definido y no está vacío
                        if (isset($mensaje) && !empty($mensaje)) {
                            echo $mensaje;
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="contenido-formu login hide">
        <div class="info">
            <div class="info-2">
                <h2>¡¡Bienvenido nuevamente!!</h2>
                <p>¡Regístrate ahora y desata tu pasión por las motos al máximo!</p>
                <input type="button" value="Registrarse" id="registro">
            </div>
        </div>

        <!--INICIO DE SESION: -->
        <div class="info-formulario">
            <div class="info-formulario-2">
                <h2>Iniciar Sesión</h2>

                <form class="form form-login" action="../../controllers/control_login2.php" method="post" id="login">
                    <div>
                        <label>
                            <i class='bx bx-envelope'></i>
                            <input type="text" placeholder="Usuario" name="usuario">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" placeholder="Contraseña" name="password">
                        </label>
                    </div>
                    <input type="submit" value="Iniciar Sesión" id="benvio">

                    <div id="mensaje-error" style="color: red;">
                        <?php
                        // Verificar si el parámetro 'error' está en la URL
                        if (isset($_GET['error'])) {
                            // Mostrar un mensaje según el valor de 'error'
                            if ($_GET['error'] == 1) {
                                echo "Usuario o contraseña incorrectos.";
                            }
                            // Puedes agregar más casos si hay otros valores para 'error'
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>

        <script src="../../views/js/Login-Registro.js"></script>
</body>

</html>