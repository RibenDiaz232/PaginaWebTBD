<?php
include "conexion.php"; // Asegúrate de incluir el archivo de conexión

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario']['idusuario'];

// Obtener la información actual del perfil
$query_perfil = "SELECT * FROM usuario WHERE idusuario = $usuario_id";
$resultado_perfil = mysqli_query($conexion, $query_perfil);
$perfil = mysqli_fetch_assoc($resultado_perfil);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<main class="container mt-5">
    <h1 class="mb-4">Perfil</h1>

    <p><strong>Nombre:</strong> <?php echo $perfil['nombre']; ?></p>
    <p><strong>Teléfono:</strong> <?php echo $perfil['telefono']; ?></p>
    <p><strong>Correo Electrónico:</strong> <?php echo $perfil['correo']; ?></p>
    <p><strong>Método de Pago:</strong> <?php echo $perfil['metodo_pago']; ?></p>
    <p><strong>Dirección de Entrega:</strong> <?php echo $perfil['direccion_entrega']; ?></p>

    <a href="editarperfil.php" class="btn btn-primary">Editar Perfil</a>
</main>
</body>
</html>
