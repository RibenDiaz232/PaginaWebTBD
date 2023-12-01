<?php
include "conexion.php"; // Asegúrate de incluir el archivo de conexión

session_start();

// Verifica si la sesión está iniciada y si el usuario está definido
if (!isset($_SESSION['idusuario'])) {
    // Redirige a la página de inicio de sesión o realiza alguna acción
    header("Location: login1.php");
    exit();
}

$usuario_id = $_SESSION['idusuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Actualizar la información del perfil
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $metodo_pago = $_POST['metodo_pago'];
    $direccion_entrega = $_POST['direccion_entrega'];

    // Utiliza una consulta preparada para mayor seguridad
    $query = "UPDATE usuario SET nombre = ?, correo = ?, metodo_pago = ?, direccion_entrega = ? WHERE idusuario = ?";

    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $email, $metodo_pago, $direccion_entrega, $usuario_id);
    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        // Redirigir a la página del perfil con un mensaje de éxito
        header("Location: perfil.php?editado=1");
        exit();
    } else {
        echo "Error al actualizar el perfil: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt);
}

// Obtener la información actual del perfil
$query_perfil = "SELECT * FROM usuario WHERE idusuario = $usuario_id";
$resultado_perfil = mysqli_query($conexion, $query_perfil);

if (!$resultado_perfil) {
    echo "Error al obtener la información del perfil: " . mysqli_error($conexion);
    exit();
}

$perfil = mysqli_fetch_assoc($resultado_perfil);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<main class="container mt-5">
    <h1 class="mb-4">Editar Perfil</h1>

    <?php if (isset($_GET['editado']) && $_GET['editado'] == 1): ?>
        <div class="alert alert-success" role="alert">
            ¡Perfil editado con éxito!
        </div>
    <?php endif; ?>

    <form method="POST" action="editarperfil.php">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $perfil['nombre']; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $perfil['correo']; ?>">
        </div>
        <div class="mb-3">
            <label for="metodo_pago" class="form-label">Método de Pago:</label>
            <input type="text" class="form-control" id="metodo_pago" name="metodo_pago" value="<?php echo $perfil['metodo_pago']; ?>">
        </div>
        <div class="mb-3">
            <label for="direccion_entrega" class="form-label">Dirección de Entrega:</label>
            <textarea class="form-control" id="direccion_entrega" name="direccion_entrega"><?php echo $perfil['direccion_entrega']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</main>
</body>
</html>
