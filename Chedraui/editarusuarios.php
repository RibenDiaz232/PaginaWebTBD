<?php
// Conexión a la base de datos y comprobación de la sesión
include "conexion.php";
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit();
}

// Verificar si se ha proporcionado un ID de usuario válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idUsuarioEditar = $_GET['id'];

    // Consultar la información del usuario
    $query = "SELECT * FROM usuario WHERE idusuario=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $idUsuarioEditar);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);

    if (!$usuario) {
        echo '<div class="alert alert-danger" role="alert">Usuario no encontrado.</div>';
        exit();
    }

    if (isset($_POST['editar'])) {
        // Obtener los datos actualizados del formulario
        $idUsuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];
        $puesto = $_POST['puesto'];

        // Actualizar los datos del usuario en la base de datos
        $query = "UPDATE usuario SET nombre=?, correo=?, contraseña=?, idPuesto=? WHERE idusuario=?";
        $stmt = mysqli_prepare($conexion, $query);
        mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $correo, $contraseña, $puesto, $idUsuario);
        
        if (mysqli_stmt_execute($stmt)) {
            echo '<div class="alert alert-success" role="alert">Los datos del usuario se actualizaron correctamente.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al actualizar los datos del usuario.</div>';
        }
    }
    
} else {
    echo '<div class="alert alert-danger" role="alert">ID de usuario no válido.</div>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Usuario</h1>
        <a href="usuarios.php" class="btn btn-secondary">Volver</a>
        <form method="post">
            <input type="hidden" name="id_usuario" value="<?php echo $usuario['idusuario']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>">
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>">
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" value="<?php echo $usuario['contraseña']; ?>">
            </div>
            <div class="form-group">
                <label for="puesto">Puesto</label>
                <input type="text" class="form-control" id="puesto" name="puesto" value="<?php echo $usuario['idPuesto']; ?>">
            </div>
            <button type="submit" name="editar" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <!-- Agrega el enlace a los archivos de Bootstrap JS (jQuery y Popper.js son necesarios) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        function mostrarPassword(id) {
            var passwordField = document.getElementById("password-" + id);
            var icon = document.getElementById("icon-" + id);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("far", "fa-eye");
                icon.classList.add("far", "fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("far", "fa-eye-slash");
                icon.classList.add("far", "fa-eye");
            }
        }
    </script>
</body>
</html>
