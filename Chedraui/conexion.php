<?php
$host = "localhost";
$usuario = "root";
$contrasena = null;
$base_de_datos = "Chedraui";

function conectarBaseDatos($contrasena) {
    $conexion = @new mysqli("localhost", "root", $contrasena, "Chedraui");

    if ($conexion->connect_error) {
        // Devuelve false si la conexión falla
        return false;
    }

    return $conexion;
}

$passwords = array("Winsome1", "Ribendiaz232");
$conexion = false; // Cambiado el nombre de la variable a $conexion

// Intentar conectar con las contraseñas
foreach ($passwords as $password) {
    $conexion = conectarBaseDatos($password);

    // Si la conexión es exitosa, sal del bucle
    if ($conexion) {
        break;
    }
}

// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}

// Ahora puedes realizar consultas con $conexion
?>
