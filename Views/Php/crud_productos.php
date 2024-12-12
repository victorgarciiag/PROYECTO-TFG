<?php
// Conexión a la base de datos
include('../../models/config.php');
include('../../models/lib.php');
$conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

// Función para añadir un accesorio
if (isset($_POST['add_product'])) {
    $titulo_producto = $_POST['titulo_producto'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen']['name'];

    // Mover la imagen a la carpeta IMG
    $target = "../../public/img/" . basename($imagen);
    move_uploaded_file($_FILES['imagen']['tmp_name'], $target);

    // Insertar el accesorio en la base de datos
    $query = "INSERT INTO accesorios (titulo_producto, precio, imagen) VALUES ('$titulo_producto', '$precio', '$imagen')";
    mysqli_query($conexion, $query);
}

// Eliminar producto
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {
    $id = $_GET['id'];

    // Eliminar el producto de la base de datos
    $query = "DELETE FROM accesorios WHERE id = $id";

    if (mysqli_query($conexion, $query)) {
        $_SESSION['mensaje'] = "Producto eliminado correctamente.";  // Mensaje de éxito
        $_SESSION['mensaje_tipo'] = "success";  // Tipo de mensaje (éxito)
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el producto: " . mysqli_error($conexion);  // Mensaje de error
        $_SESSION['mensaje_tipo'] = "error";  // Tipo de mensaje (error)
    }

    header('Location: crud_productos.php');  // Redirigir para evitar el reenvío del formulario
    exit();
}

// Función para editar un accesorio
if (isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $titulo_producto = $_POST['titulo_producto'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen']['name'];

    // Si hay nueva imagen, moverla
    if ($imagen) {
        $target = "../IMG/" . basename($imagen);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $target);
        $query = "UPDATE accesorios SET titulo_producto='$titulo_producto', precio='$precio', imagen='$imagen' WHERE id=$id";
    } else {
        $query = "UPDATE accesorios SET titulo_producto='$titulo_producto', precio='$precio' WHERE id=$id";
    }

    if (mysqli_query($conexion, $query)) {
        $_SESSION['mensaje'] = "Producto actualizado correctamente.";  // Mensaje de éxito
        $_SESSION['mensaje_tipo'] = "success";  // Tipo de mensaje (éxito)
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el producto: " . mysqli_error($conexion);  // Mensaje de error
        $_SESSION['mensaje_tipo'] = "error";  // Tipo de mensaje (error)
    }

    header('Location: crud_productos.php');  // Redirigir a la misma página con el mensaje
    exit();
}

// Consultar productos existentes para mostrar en la lista
$query = "SELECT * FROM accesorios";
$result = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Accesorios</title>
    <link rel="stylesheet" href="../../views/css/style_crud_productos.css">
    <link rel="icon" href="../../Public/Img/logo2.jpg" type="image/png">
</head>

<body>
    <nav>
        <div class="logo">
            <a href="../../views/php/opciones_area_personal.php"><img src="../../public/img/logo3.webp" alt="Logo"></a>
        </div>
    </nav>

    <h1>Gestión de Accesorios</h1>

    <!-- Mostrar mensaje si existe -->
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="message <?php echo $_SESSION['mensaje_tipo']; ?>">
            <?php echo $_SESSION['mensaje']; ?>
        </div>
        <?php unset($_SESSION['mensaje']); // Limpiar mensaje después de mostrarlo 
        ?>
        <?php unset($_SESSION['mensaje_tipo']); // Limpiar tipo de mensaje 
        ?>
    <?php endif; ?>

    <!-- Formulario para añadir un nuevo producto -->
    <div class="container">
        <h2>Añadir Nuevo Producto</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="titulo_producto">Título del Producto:</label>
            <input type="text" name="titulo_producto" required><br>

            <label for="precio">Precio (€):</label>
            <input type="number" name="precio" required><br>

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" required><br>

            <button type="submit" name="add_product">Añadir Producto</button>
        </form>
    </div>

    <?php
    // Si se hace clic en "Editar", cargar el formulario de edición
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $query = "SELECT * FROM accesorios WHERE id = $id";
        $result = mysqli_query($conexion, $query);
        $product = mysqli_fetch_assoc($result);
    ?>
        <!-- Formulario para editar un producto (justo debajo del de añadir) -->
        <div class="container">
            <h2>Editar Producto</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                <label for="titulo_producto">Título del Producto:</label>
                <input type="text" name="titulo_producto" value="<?php echo $product['titulo_producto']; ?>" required><br>

                <label for="precio">Precio (€):</label>
                <input type="number" name="precio" value="<?php echo $product['precio']; ?>" required><br>

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen"><br>

                <button type="submit" name="edit_product">Actualizar Producto</button>
            </form>
        </div>
    <?php
    }
    ?>

    <!-- Lista de productos existentes -->
    <div class="container">
        <h2>Lista de Productos</h2>
        <table class="product-list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['titulo_producto']; ?></td>
                        <td><?php echo $row['precio']; ?>€</td>
                        <td><img src="../../public/img/<?php echo $row['imagen']; ?>" alt="<?php echo $row['titulo_producto']; ?>" width="100"></td>
                        <td>
                            <!-- Enlace para eliminar el producto -->
                            <a href="crud_productos.php?accion=eliminar&id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')">Eliminar</a>

                            <!-- Botón para editar el producto -->
                            <a href="crud_productos.php?edit=<?php echo $row['id']; ?>" class="edit">Editar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>