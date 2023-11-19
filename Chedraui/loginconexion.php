<?php
include "conexion.php";

if (isset($_POST["register"])) {
    $nombreCompleto = $_POST["nombre-completo"];
    $telefono = $_POST["numero-de-telefono"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consulta SQL para insertar los datos del usuario en la base de datos
    $sql = "INSERT INTO usuario (nombre, telefono, correo, contraseña) VALUES ('$nombreCompleto', '$telefono', '$email', '$password')";
    
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
