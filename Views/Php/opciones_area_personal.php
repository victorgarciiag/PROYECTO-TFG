<?php
session_start(); // Asegúrate de iniciar la sesión al principio de la página

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Redirigir al login si no hay sesión
    exit();
}

// Obtener el nombre de usuario de la sesión
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Opciones</title>
    <link rel="stylesheet" href="../../views/css/style_opciones_areapersonal.css">
    <link rel="icon" href="../../Public/Img/logo2.jpg" type="image/png">
</head>

<body>
    <nav>
        <div class="logo">
            <a href="../../index.php"><img src="../../public/img/logo3.webp" alt="Logo"></a>
        </div>
    </nav>

    <!-- Muestra el nombre de usuario y el botón de cerrar sesión fuera de la overlay -->
    <div class="user-info">
        <p>Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</p>
        <form action="../../controllers/cerrar_sesion.php" method="POST">
            <input type="submit" value="Cerrar Sesión" class="button">
        </form>
    </div>

    <div class="overlay">
        <div class="options">
            <h1>¿Qué deseas hacer?</h1>
            <div class="buttons">
                <a href="../../views/php/crud_noticias.php" class="button">Añadir noticias</a>
                <a href="../../views/php/crud_productos.php" class="button">Añadir productos</a>
                <a href="../../views/php/panel_registros_ayuda.php" class="button">Ver panel Registros Ayuda</a>
                <a href="../../views/php/panel_registros_reserva.php" class="button">Ver panel Registros Reservas</a>
            </div>
        </div>
    </div>
</body>

</html>