<?php
include "conexion.php"; // Asegúrate de incluir el archivo de conexión

session_start();

// Verifica si ya hay una sesión activa
if (isset($_SESSION['idusuario'])) {
    // Redirige a la página de editar perfil si ya hay una sesión activa
    header("Location: editarperfil.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar las credenciales del usuario
    $query = "SELECT idusuario FROM usuario WHERE correo = ? AND contrasena = ?";
    
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ss", $correo, $contrasena);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Verifica si se encontró un usuario con las credenciales proporcionadas
    if (mysqli_stmt_num_rows($stmt) == 1) {
        // Inicia sesión
        mysqli_stmt_bind_result($stmt, $idusuario);
        mysqli_stmt_fetch($stmt);
        $_SESSION['idusuario'] = $idusuario;
        
        // Redirige directamente a la página de editar perfil
        header("Location: editarperfil.php");
        exit();
    } else {
        $mensaje_error = "Credenciales incorrectas. Inténtalo de nuevo.";
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<main class="container mt-5">
    <h1 class="mb-4">Iniciar Sesión</h1>

    <?php if (isset($mensaje_error)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $mensaje_error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electrónico:</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
</main>
</body>
</html>
