<?php
include "conexion.php";

if (isset($_POST["login"])) {
    $usuario = $_POST['email'];
    $contraseña = $_POST['password'];
    session_start();
    $_SESSION['email'] = $usuario;

    $host = "localhost";
    $usuario_db = "root";
    $contrasena_db = "Winsome1";
    $base_de_datos = "chedraui";

    $conexion = mysqli_connect($host, $usuario_db, $contrasena_db, $base_de_datos);

    // Consulta preparada para evitar la inyección de SQL
    $consulta = "SELECT * FROM usuario WHERE correo=? AND contraseña=?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $contraseña);
    mysqli_stmt_execute($stmt);

    // Obtiene el resultado de la consulta preparada
    $resultado = mysqli_stmt_get_result($stmt);
    
    // Verifica si se encontraron filas
    if ($resultado && $fila = mysqli_fetch_array($resultado)) {
        if ($fila['idPuesto'] == 1) { // es el admin
            header("location: admin.php");
            exit();
        } elseif ($fila['idPuesto'] == 2) { // es un cliente plebeyo
            header("location: cliente.php");
            $consulta = "INSERT INTO usuario (nombre, email, contraseña, idPuesto) VALUES (?, ?, ?, 2)";
$stmt = mysqli_prepare($conexion, $consulta);
mysqli_stmt_bind_param($stmt, "sss", $nombre, $email, $contraseña);
mysqli_stmt_execute($stmt);
            exit();
        } else {
            ?>
            <h1 class="bad">ERROR EN LA AUTENTICACION</h1>
            <?php
            include "index.php";
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>
