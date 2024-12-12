<?php
$controla = false;
include('../models/config.php');
include('../models/lib.php');

// Recoger los datos del formulario
$nombreCompleto = $_POST['nombre'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$email = $_POST['email'];
$tel = $_POST['telefono'];
$fechaNacimiento = $_POST['fechaNacimiento'];

// Validación básica de los campos (puedes agregar más validaciones según sea necesario)
if (empty($nombreCompleto) || empty($usuario) || empty($password) || empty($email) || empty($tel) || empty($fechaNacimiento)) {
    $mensaje = 'Todos los campos son obligatorios.';
    header("Location: ../views/html/registro.php?error=$mensaje");
    exit();
}

// Crear conexión
$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

// Verificar si el usuario ya existe
$sql = 'SELECT * FROM usuarios WHERE usuario = ?';
$stmt = $conexion->prepare($sql);
$stmt->bind_param('s', $usuario); // 's' indica que es un string
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $mensaje = 'El nombre de usuario ya está en uso.';
    header("Location: ../views/html/registro.php?error=$mensaje");
    exit();
} else {
    // Hashear la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta para insertar un nuevo usuario
    $sql = 'INSERT INTO usuarios (nombre_completo, usuario, contrasena, email, telefono, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ssssss', $nombreCompleto, $usuario, $hashedPassword, $email, $tel, $fechaNacimiento); // 's' indica que todos los parámetros son strings

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../views/html/registro_correcto.html');
    } else {
        $mensaje = 'Hubo un error al registrarse, por favor intenta nuevamente.';
        header("Location: ../views/html/registro.php?error=$mensaje");
    }
}

// Cerrar la conexión
$stmt->close();
mysqli_close($conexion);
