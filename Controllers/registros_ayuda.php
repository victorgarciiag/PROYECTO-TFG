<?php
$controla = false;
include('../models/config.php');
include('../models/lib.php');

// Crear conexión
$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? ''; // Asegúrate de que coincida
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $incidencia = $_POST['incidencia'] ?? ''; // Corrige el nombre del campo
    $fecha = $_POST['fecha'] ?? ''; // Corrige el nombre del campo
    $descripcion = $_POST['descripcion'] ?? '';

    // Manejo del archivo adjunto
    $archivo_adjunto = NULL; // Inicializar como NULL
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $archivo_adjunto = $_FILES['archivo']['name'];
        // Mover el archivo subido a una carpeta en el servidor
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
        move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file);
    }

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO formularios_ayuda (nombre_completo, email, telefono, tipo_incidencia, fecha_incidencia, descripcion, archivo_adjunto)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssss", $nombre, $email, $telefono, $incidencia, $fecha, $descripcion, $archivo_adjunto); // Asegúrate de que coincida con los nombres de variables

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: ../views/html/registro_correcto.html');
    } else {
        echo "Error al insertar los datos: " . $conexion->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
}
