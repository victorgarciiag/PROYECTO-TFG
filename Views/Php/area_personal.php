<?php
$controla = false;
include('../../models/config.php');
include('../../models/lib.php');

// Verificar si se pasó el parámetro de error en la URL
$error = isset($_GET['error']) && $_GET['error'] == 1 ? "ERROR: Usuario o contraseña incorrectos" : "";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Personal</title>
    <link rel="stylesheet" href="../../views/css/style_area_personal.css">
    <link rel="icon" href="../../Public/Img/logo2.jpg" type="image/png">
</head>

<body>
    <header>
        <a href="../../index.php"><img src="../../public/img/logo3.webp" alt="Logo"></a>
    </header>

    <!-- INICIO DE SESION -->
    <div class="info-formulario">
        <div class="info-formulario-2">
            <h2>Iniciar Sesión</h2>

            <form class="form form-login" action="../../controllers/control_login.php" method="post" id="login">
                <div>
                    <label>
                        <i class='bx bx-envelope'></i>
                        <input type="text" placeholder="Usuario" name="usuario" required>
                    </label>
                </div>
                <div>
                    <label>
                        <i class='bx bx-lock-alt'></i>
                        <input type="password" placeholder="Contraseña" name="password" required>
                    </label>
                </div>
                <input type="submit" value="Iniciar Sesión" id="benvio">

                <!-- Mostrar el mensaje de error si existe -->
                <?php if ($error): ?>
                    <div id="mensaje-error" style="color: red; margin-top: 10px;"><?php echo $error; ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>

</html>