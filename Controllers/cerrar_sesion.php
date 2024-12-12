<?php
session_start(); // Iniciar la sesión
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirigir al login
header('Location: ../views/php/area_personal.php');
exit();
?>