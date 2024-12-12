<?php
// Conexión a la base de datos
include('../../models/config.php');
include('../../models/lib.php');
$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);



// Crear una nueva noticia
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'agregar') {
    // Verificar si el archivo de imagen fue enviado correctamente
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        // Obtener los datos del formulario
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $link_video = $_POST['link_video'];

        // Subir la imagen
        $imagen = $_FILES['imagen'];
        $imagen_nombre = $imagen['name'];
        $imagen_temp = $imagen['tmp_name'];
        $imagen_error = $imagen['error'];

        // Verificar que no haya errores en la carga de la imagen
        if ($imagen_error === 0) {
            // Definir la carpeta de destino para las imágenes
            $carpeta_destino = "uploads/";

            // Verificar si la carpeta existe, si no, crearla
            if (!is_dir($carpeta_destino)) {
                mkdir($carpeta_destino, 0777, true);  // Crea la carpeta si no existe
            }

            // Crear un nombre único para la imagen
            $imagen_destino = $carpeta_destino . uniqid('', true) . "-" . basename($imagen_nombre);

            // Mover la imagen al servidor
            if (move_uploaded_file($imagen_temp, $imagen_destino)) {
                // Insertar los datos en la base de datos
                $query = "INSERT INTO noticias (titulo, descripcion, imagen, link_video) 
                          VALUES ('$titulo', '$descripcion', '$imagen_destino', '$link_video')";

                if (mysqli_query($conexion, $query)) {
                    $_SESSION['mensaje'] = "Noticia añadida correctamente.";  // Mensaje de éxito
                    $_SESSION['mensaje_tipo'] = "success";  // Tipo de mensaje (éxito)
                } else {
                    $_SESSION['mensaje'] = "Error al añadir la noticia: " . mysqli_error($conexion);  // Mensaje de error
                    $_SESSION['mensaje_tipo'] = "error";  // Tipo de mensaje (error)
                }
            } else {
                $_SESSION['mensaje'] = "Error al subir la imagen.";  // Mensaje de error
                $_SESSION['mensaje_tipo'] = "error";  // Tipo de mensaje (error)
            }
        } else {
            $_SESSION['mensaje'] = "Hubo un error al subir la imagen.";  // Mensaje de error
            $_SESSION['mensaje_tipo'] = "error";  // Tipo de mensaje (error)
        }
    } else {
        $_SESSION['mensaje'] = "No se ha seleccionado una imagen o hubo un error en el archivo.";  // Mensaje de error
        $_SESSION['mensaje_tipo'] = "error";  // Tipo de mensaje (error)
    }

    header('Location: crud_noticias.php');  // Redirigir para evitar el reenvío del formulario
    exit();
}

// Actualizar noticia
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'actualizar') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $link_video = $_POST['link_video'];

    // Verificar si se ha subido una nueva imagen
    $imagen_destino = $_POST['imagen_actual'];  // Mantener la imagen actual si no se sube una nueva

    if (!empty($_FILES['imagen']['name'])) {
        // Subir la nueva imagen
        $imagen = $_FILES['imagen'];
        $imagen_nombre = $imagen['name'];
        $imagen_temp = $imagen['tmp_name'];
        $imagen_error = $imagen['error'];

        if ($imagen_error === 0) {
            $carpeta_destino = "uploads/";
            $imagen_destino = $carpeta_destino . uniqid('', true) . "-" . $imagen_nombre;
            move_uploaded_file($imagen_temp, $imagen_destino);
        } else {
            $_SESSION['mensaje'] = "Hubo un error al subir la imagen.";  // Mensaje de error
            $_SESSION['mensaje_tipo'] = "error";  // Tipo de mensaje (error)
            header('Location: crud_noticias.php');
            exit();
        }
    }

    // Actualizar los datos de la noticia en la base de datos
    $query = "UPDATE noticias SET titulo='$titulo', descripcion='$descripcion', imagen='$imagen_destino', link_video='$link_video' WHERE id=$id";

    if (mysqli_query($conexion, $query)) {
        $_SESSION['mensaje'] = "Noticia actualizada correctamente.";  // Mensaje de éxito
        $_SESSION['mensaje_tipo'] = "success";  // Tipo de mensaje (éxito)
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la noticia: " . mysqli_error($conexion);  // Mensaje de error
        $_SESSION['mensaje_tipo'] = "error";  // Tipo de mensaje (error)
    }

    header('Location: crud_noticias.php');  // Redirigir para evitar el reenvío del formulario
    exit();
}

// Eliminar noticia
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {
    $id = $_GET['id'];

    // Eliminar la noticia de la base de datos
    $query = "DELETE FROM noticias WHERE id = $id";

    if (mysqli_query($conexion, $query)) {
        $_SESSION['mensaje'] = "Noticia eliminada correctamente.";  // Mensaje de éxito
        $_SESSION['mensaje_tipo'] = "success";  // Tipo de mensaje (éxito)
    } else {
        $_SESSION['mensaje'] = "Error al eliminar la noticia: " . mysqli_error($conexion);  // Mensaje de error
        $_SESSION['mensaje_tipo'] = "error";  // Tipo de mensaje (error)
    }

    header('Location: crud_noticias.php');  // Redirigir para evitar el reenvío del formulario
    exit();
}

// Mostrar mensaje en la página
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    $tipo = $_SESSION['mensaje_tipo'];

    // Estilo en línea para los mensajes
    if ($tipo == 'success') {
        echo "<p style='background-color: #d4edda; color: #155724; padding: 10px 20px; border-radius: 5px; margin: 10px 0; text-align: center;'>$mensaje</p>";
    } elseif ($tipo == 'error') {
        echo "<p style='background-color: #f8d7da; color: #721c24; padding: 10px 20px; border-radius: 5px; margin: 10px 0; text-align: center;'>$mensaje</p>";
    }

    unset($_SESSION['mensaje']);  // Borrar el mensaje después de mostrarlo
    unset($_SESSION['mensaje_tipo']);  // Borrar el tipo de mensaje
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Noticias</title>
    <link rel="stylesheet" href="../../views/css/style_crud_noticias.css">
    <link rel="icon" href="../../Public/Img/logo2.jpg" type="image/png">
</head>

<body>
    <nav>
        <div class="logo">
            <a href="../../views/PHP/opciones_area_personal.php"><img src="../../public/IMG/logo3.webp" alt="Logo"></a>
        </div>
    </nav>
    <div class="container">

        <h1>Gestión de Noticias</h1>

        <!-- Mostrar el mensaje de éxito o error -->
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo "<p>" . $_SESSION['mensaje'] . "</p>";
            unset($_SESSION['mensaje']);  // Borrar el mensaje después de mostrarlo
        }
        ?>

        <!-- Formulario para agregar una noticia -->
        <h2>Añadir Noticia</h2>
        <form action="crud_noticias.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="accion" value="agregar">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required><br><br>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" required></textarea><br><br>

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" accept="image/*" required><br><br>

            <label for="link_video">Enlace del Video:</label>
            <input type="url" name="link_video" id="link_video" required><br><br>

            <button type="submit">Añadir Noticia</button>
        </form>

        <!-- Formulario adicional para editar una noticia -->


        <!-- Mostrar todas las noticias -->
        <h2>Noticias Actuales</h2>
        <?php
        // Consultar todas las noticias
        $result = mysqli_query($conexion, "SELECT * FROM noticias");

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="noticia">
                <h3><?php echo $row['titulo']; ?></h3>
                <img src="<?php echo $row['imagen']; ?>" alt="Imagen noticia" width="100">
                <p><?php echo $row['descripcion']; ?></p>
                <a href="<?php echo $row['link_video']; ?>" target="_blank" class="youtube-link">Ver en Youtube</a><br><br>

                <!-- Botones de editar y eliminar -->
                <div class="botones">
                    <a href="crud_noticias.php?accion=editar&id=<?php echo $row['id']; ?>" class="edit">Editar</a>
                    <a href="crud_noticias.php?accion=eliminar&id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('¿Estás seguro de que quieres eliminar esta noticia?')">Eliminar</a>
                </div>

            </div>
        <?php
        }
        ?>

    </div>
</body>

</html>