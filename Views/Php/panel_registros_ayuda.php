<?php
include('../../models/config.php');
include('../../models/lib.php');

// Crear conexión
$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

// Inicializar variables para almacenar los filtros
$filtro = '';
$nombreFiltro = '';
$sql = "SELECT * FROM formularios_ayuda"; // Consulta por defecto sin filtros

// Comprobar si se ha enviado el formulario de filtro general
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['filtro']) && !empty($_POST['filtro'])) {
        $filtro = $_POST['filtro'];

        // Consulta para obtener registros filtrados según el filtro seleccionado
        switch ($filtro) {
            case 'diario':
                $sql = "SELECT * FROM formularios_ayuda WHERE DATE(fecha_incidencia) = CURDATE()"; // Filtrar por el día actual
                break;
            case 'semanal':
                $sql = "SELECT * FROM formularios_ayuda WHERE YEARWEEK(fecha_incidencia, 1) = YEARWEEK(CURDATE(), 1)"; // Filtrar por la semana actual
                break;
            case 'mensual':
                $sql = "SELECT * FROM formularios_ayuda WHERE MONTH(fecha_incidencia) = MONTH(CURDATE()) AND YEAR(fecha_incidencia) = YEAR(CURDATE())"; // Filtrar por el mes actual
                break;
            case 'todo':
                $sql = "SELECT * FROM formularios_ayuda";
                break;
        }
    }

    // Comprobar si se ha enviado el formulario de filtro por nombre
    if (isset($_POST['filtrarNombre']) && !empty($_POST['nombreFiltro'])) {
        $nombreFiltro = $_POST['nombreFiltro'];
        $sql = "SELECT * FROM formularios_ayuda WHERE nombre_completo LIKE '%" . $conexion->real_escape_string($nombreFiltro) . "%'"; // Filtrar por nombre
    }
}

// Ejecutar la consulta
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Ayuda - Concesionario de Motos</title>
    <link rel="stylesheet" href="../../views/css/style_panel_ayuda.css">
    <link rel="icon" href="../../Public/Img/logo2.jpg" type="image/png">
</head>

<body>
    <nav>
        <div class="logo">
            <a href="../../views/php/opciones_area_personal.php"><img src="../../public/img/logo3.webp" href="../PHP/index.php"></a>
        </div>
    </nav>
    <div class="container">
        <h1>Panel de Registros de Ayuda</h1>

        <!-- Filtro general por rango de tiempo -->
        <form method="post">
            <label for="filtro">Filtrar por:</label>
            <select name="filtro" id="filtro">
                <option value="">-- Seleccionar --</option>
                <option value="todo" <?php echo ($filtro == 'todo') ? 'selected' : ''; ?>>Mostrar todo</option>
                <option value="diario" <?php echo ($filtro == 'diario') ? 'selected' : ''; ?>>Día actual</option>
                <option value="semanal" <?php echo ($filtro == 'semanal') ? 'selected' : ''; ?>>Esta semana</option>
                <option value="mensual" <?php echo ($filtro == 'mensual') ? 'selected' : ''; ?>>Este mes</option>
            </select>
            <button type="submit">Filtrar</button>
        </form>

        <!-- Filtro independiente por nombre -->
        <form method="post">
            <label for="nombreFiltro">Filtrar por nombre:</label>
            <input type="text" name="nombreFiltro" id="nombreFiltro" value="<?php echo htmlspecialchars($nombreFiltro); ?>" placeholder="Ingrese un nombre">
            <button type="submit" name="filtrarNombre">Filtrar por Nombre</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Tipo de Incidencia</th>
                    <th>Fecha de la Incidencia</th>
                    <th>Descripción</th>
                    <th>Archivo Adjunto</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar si hay resultados
                if ($resultado && $resultado->num_rows > 0) {
                    // Mostrar los datos de cada fila
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($fila['nombre_completo'] ?? '') . "</td>";
                        echo "<td>" . htmlspecialchars($fila['email'] ?? '') . "</td>";
                        echo "<td>" . htmlspecialchars($fila['telefono'] ?? '') . "</td>";
                        echo "<td>" . htmlspecialchars($fila['tipo_incidencia'] ?? '') . "</td>"; // Tipo de incidencia
                        echo "<td>" . htmlspecialchars($fila['fecha_incidencia'] ?? '') . "</td>"; // Fecha de la incidencia
                        echo "<td>" . nl2br(htmlspecialchars($fila['descripcion'] ?? '')) . "</td>";
                        echo "<td>" . (!empty($fila['archivo']) ? 'SI' : 'NO') . "</td>"; // Mostrar "SI" o "NO" para el archivo
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay registros disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
// Cerrar la conexión
$conexion->close();
?>