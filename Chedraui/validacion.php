<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han enviado los datos de inicio de sesión
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Realizar la validación del usuario (puedes ajustar esto según tu lógica de validación)
        $conn = conectarBaseDatos($password);

        // Verificar si la conexión fue exitosa
        if ($conn) {
            // Verificar si el usuario es administrador o cliente (puedes ajustar esto según tu lógica)
            $esAdministrador = true; // Ejemplo: supongamos que el usuario admin tiene acceso

            // Redirigir según el tipo de usuario
            if ($esAdministrador) {
                header("Location: admin.php");
                exit();
            } else {
                header("Location: cliente.php");
                exit();
            }
        } else {
            echo "Error en la conexión a la base de datos.";
        }
    } else {
        echo "Faltan datos de inicio de sesión.";
    }
} else {
    // Si alguien intenta acceder directamente a este archivo sin enviar datos, redirigir a la página principal
    header("Location: index.php");
    exit();
}
?>
