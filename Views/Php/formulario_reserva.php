<?php
$controla = false;
include('../../models/config.php');
include('../../models/lib.php');

// Crear la conexión
$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

// Verificar la conexión
if ($conexion->connect_error) {
    die("La conexión ha fallado: " . $conexion->connect_error);
}

// Inicializar mensaje de éxito
$mensajeExito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $servicio = $_POST['servicio'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $comentarios = $_POST['comentarios'];
    $concesionario = $_POST['concesionario'];

    $sql = "INSERT INTO reservas (nombre, email, telefono, servicio, cantidad, fecha, hora, comentarios, concesionario)
            VALUES ('$nombre', '$email', '$telefono', '$servicio', '$cantidad', '$fecha', '$hora', '$comentarios', '$concesionario')";

    if ($conexion->query($sql) === TRUE) {
        $mensajeExito = "¡Reserva registrada con éxito!";
    } else {
        $mensajeExito = "Error al registrar la reserva: " . $conexion->error;
    }
}

$fechaSeleccionada = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
$horasDisponibles = [];
$horarios = ["09:00:00", "10:00:00", "11:00:00", "12:00:00", "13:00:00", "17:00:00", "18:00:00", "19:00:00"];

$sqlHorasReservadas = "SELECT hora FROM reservas WHERE fecha = '$fechaSeleccionada'";
$result = $conexion->query($sqlHorasReservadas);

$horasReservadas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $horasReservadas[] = $row['hora'];
    }
}

foreach ($horarios as $hora) {
    if (!in_array($hora, $horasReservadas)) {
        $horasDisponibles[] = $hora;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reserva</title>
    <link rel="icon" href="../../Public/Img/logo2.jpg" type="image/png">
    <link rel="stylesheet" href="../Css/formulario_reserva.css">
</head>

<body>

    <header>
        <div class="logo">
            <a href="../../index.php"><img src="../../public/img/logo3.webp" alt="Logo"></a>
        </div>
    </header>

    <h1>Formulario de Reserva</h1>

    <?php if (!empty($mensajeExito)) : ?>
        <div class="mensaje-exito">
            <?= $mensajeExito; ?>
        </div>
    <?php endif; ?>

    <div class="formulario">
        <form action="" method="POST">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>

            <label for="servicio">Tipo de Servicio:</label>
            <select id="servicio" name="servicio" required>
                <option value="consultoria">Consultoría</option>
                <option value="reserva moto">Reserva de Moto</option>
                <option value="mantenimiento">Mantenimiento</option>
                <option value="otros">Otros</option>
            </select>

            <label for="cantidad">Cantidad de Personas:</label>
            <input type="number" id="cantidad" name="cantidad" min="1" value="1" required>

            <label for="fecha">Fecha de Reserva:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="hora">Hora de Reserva:</label>
            <select id="hora" name="hora" required>
                <?php foreach ($horasDisponibles as $hora) : ?>
                    <option value="<?= $hora; ?>"><?= $hora; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="concesionario">Selecciona Concesionario:</label>
            <select id="concesionario" name="concesionario" required>
                <option value="Concesionario KTM - Sevilla">Concesionario KTM - Sevilla</option>
                <option value="Concesionario KTM - Madrid">Concesionario KTM - Madrid</option>
                <option value="Concesionario KTM - Barcelona">Concesionario KTM - Barcelona</option>
                <option value="Concesionario KTM - Valencia">Concesionario KTM - Valencia</option>
                <option value="Concesionario KTM - Málaga">Concesionario KTM - Málaga</option>
                <option value="Concesionario KTM - Bilbao">Concesionario KTM - Bilbao</option>
                <option value="Concesionario KTM - Murcia">Concesionario KTM - Murcia</option>
                <option value="Concesionario KTM - Vigo">Concesionario KTM - Vigo</option>
                <option value="Concesionario KTM - Tenerife">Concesionario KTM - Tenerife</option>
                <option value="Concesionario KTM - Alicante">Concesionario KTM - Alicante</option>
            </select>

            <label for="comentarios">Comentarios Especiales:</label>
            <textarea id="comentarios" name="comentarios" placeholder="Escribe cualquier comentario o petición especial..."></textarea>

            <button type="submit">Confirmar Reserva</button>
        </form>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const fechaSeleccionada = urlParams.get('fecha');

        if (fechaSeleccionada) {
            document.getElementById('fecha').value = fechaSeleccionada;
        }
    </script>

</body>

</html>