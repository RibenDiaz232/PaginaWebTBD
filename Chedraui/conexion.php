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
$conexion = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

// Intentar conectar con las contraseñas
foreach ($passwords as $password) {
    $conn = conectarBaseDatos($password);
    
    // Si la conexión es exitosa, sal del bucle
    if ($conn) {
        break;
    }
}

// Verificar si se estableció una conexión
if (!$conn) {
    die("No se pudo conectar a la base de datos.");
}
?>
