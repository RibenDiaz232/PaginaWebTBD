<?php
include "conexion.php";

// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}


if (isset($_POST["register"])) {
    $nombreCompleto = $_POST["nombre-completo"];
    $telefono = $_POST["numero-de-telefono"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consulta SQL para insertar los datos del usuario en la base de datos, y mismo de validado el usuario como cliente en el puesto con ID 2.
    $sql = "INSERT INTO usuario (nombre, telefono, correo, contraseña, idPuesto) VALUES ('$nombreCompleto', '$telefono', '$email', '$password', 2)";
    
    if ($conexion->query($sql) === TRUE) {
        header('location:index.php');
        //echo "Usuario registrado correctamente.";
        // Puedes redirigir al usuario a otra página aquí si lo deseas
    } else {
        echo "Error al registrar el usuario: " . $conexion->error;
    }
}

$conexion->close();
?>
