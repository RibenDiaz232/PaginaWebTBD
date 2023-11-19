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
// ...

// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $botonInicioSesion = "";  // No se muestra el botón de inicio de sesión
    $menuUsuario = "<li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            $usuario
                        </a>
                        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                            <a class='dropdown-item' href='perfil.php'>Ver Perfil</a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item' href='cerrar_sesion.php'>Cerrar Sesión</a>
                        </div>
                    </li>";
} else {
    $usuario = '';  // No hay usuario
    $botonInicioSesion = "<li class='nav-item'>
                            <a class='nav-link' href='login.php'>Iniciar Sesión</a>
                        </li>";
    $menuUsuario = '';  // No se muestra el menú de usuario
}

?>
