<?php
function conectarBaseDatos($contrasena) {
    global $host, $usuario, $base_de_datos;
    
    // Solo intentar conectar si la contraseña no está vacía
    if (!empty($contrasena)) {
        try {
            $conexion = new mysqli("localhost", "root", $contrasena, "chedraui");
            
            // Si la conexión es exitosa, regresa la conexión
            if (!$conexion->connect_error) {
                return $conexion;
            }
        } catch (Exception $e) {
            // En caso de error, continuar con la siguiente contraseña
        }
    }

    // Si la contraseña está vacía o la conexión falla, regresa false
    return false;
}

$passwords = array("Winsome1", "Ribendiaz232", "martinmp03*");
$conexion = null;

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
?>
