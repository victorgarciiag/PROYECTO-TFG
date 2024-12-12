<?php
$controla = false;
include('../models/config.php');
include('../models/lib.php');

// Verificar que el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Crear conexión
    $conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

    // Preparar la consulta para buscar al usuario
    $sql = 'SELECT * FROM usuarios WHERE usuario = ?';
    $stmt = $conexion->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . $conexion->error);
    }

    // Vincular el parámetro y ejecutar la consulta
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si el usuario existe
    if ($resultado->num_rows == 0) {
        // Si no hay usuario, redirigir de nuevo al formulario con el mensaje de error
        header('Location: ../views/php/login.php?error=1');
        exit();
    } else {
        $reg = $resultado->fetch_assoc(); // Obtener los datos del usuario

        // Verificar si la contraseña es correcta utilizando password_verify
        if (password_verify($password, $reg['contrasena'])) {
            // Iniciar sesión
            session_start();
            $_SESSION['usuario'] = $reg['usuario'];
            $_SESSION['idusuario'] = $reg['idusuario'];
            $_SESSION['rol'] = $reg['rol'];

            // Redirigir a la página de reserva
            header('Location: ../views/php/reserva.php');
            exit();
        } else {
            // Contraseña incorrecta
            header('Location: ../views/php/login.php?error=1');
            exit();
        }
    }

    // Cerrar la conexión
    $stmt->close();
    mysqli_close($conexion);
}
