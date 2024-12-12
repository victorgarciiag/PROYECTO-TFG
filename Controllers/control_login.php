    <?php
    $controla = false;
    include('../models/config.php');
    include('../models/lib.php');

    $hayUsuario = false;
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Crear conexión
    $conexion = conectarse($servidor, $usuarioservidor, $claveservidor, $bbdd, $puerto);

    // Preparar el string que contendrá la instrucción SQL
    $sql = 'SELECT * FROM usuarios_admin WHERE usuario="' . $usuario . '" AND contrasena="' . $password . '";';

    // Enviar la consulta al servidor MySQL a través de la conexión creada, y almacenar resultado en una variable
    $consulta = mysqli_query($conexion, $sql);

    // Verificar si hay algún usuario como resultado
    $cuantos = mysqli_num_rows($consulta); // Almacenamos en $cuantos la cantidad de filas recogidas en la consulta
    if ($cuantos == 0) {
        // Si no hay usuario, redirigir de nuevo al formulario con el mensaje de error
        header('Location: ../views/php/area_personal.php?error=1');
        exit();
    } else {
        $reg = mysqli_fetch_array($consulta); // Almacenamos en $reg el array con los datos del usuario que están en la consulta
        $_SESSION['usuario'] = $usuario; // Creamos la variable de sesión 'usuario' para que sea accesible en todas las páginas en las que se inicie sesión.
        $_SESSION['usuario'] = $reg['usuario'];
        $_SESSION['idusuario'] = $reg['idusuario'];
        $_SESSION['rol'] = $reg['rol'];
        header('Location: ../views/php/opciones_area_personal.php');
        exit();
    }
    ?>