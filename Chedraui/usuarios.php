<?php
// Incluye la conexión a la base de datos y verifica la sesión del usuario
include "conexion.php";

// Función para obtener la lista de usuarios desde la base de datos
function obtenerUsuarios($conexion) {
    $query = "SELECT * FROM usuario";
    $resultado = mysqli_query($conexion, $query);
    $usuarios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    return $usuarios;
}

// Función para eliminar un usuario por ID
function eliminarUsuario($conexion, $id) {
    $query = "DELETE FROM usuario WHERE idusuario = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

// Función para actualizar el puesto de un usuario por ID
function actualizarPuesto($conexion, $id, $nuevoPuesto) {
    $query = "UPDATE usuario SET idPuesto = ? WHERE idusuario = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "si", $nuevoPuesto, $id);
    mysqli_stmt_execute($stmt);
}

// Función para generar y guardar un código de restablecimiento de contraseña
function generarYGuardarCodigoRestablecimiento($conexion, $idUsuario) {
    $codigoRestablecimiento = generarCodigoUnico();
    $codigoExpiracion = date('Y-m-d H:i:s', strtotime('+1 hour')); // Establecer una expiración de 1 hora

    $query = "UPDATE usuario SET codigoRestablecimiento = ?, codigoExpiracion = ? WHERE idusuario = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $codigoRestablecimiento, $codigoExpiracion, $idUsuario);
    mysqli_stmt_execute($stmt);

    // Puedes enviar el código al usuario por correo electrónico aquí
    echo "Se ha generado un código de restablecimiento para el usuario con ID $idUsuario: $codigoRestablecimiento";
}

// Función para generar un código único
function generarCodigoUnico($longitud = 8) {
    return bin2hex(random_bytes($longitud));
}

if (isset($_POST['eliminar'])) {
    $idEliminar = $_POST['id_eliminar'];
    eliminarUsuario($conexion, $idEliminar);
}

if (isset($_POST['actualizar_puesto'])) {
    $idActualizar = $_POST['id_actualizar'];
    $nuevoPuesto = $_POST['nuevo_puesto'];
    actualizarPuesto($conexion, $idActualizar, $nuevoPuesto);
}

if (isset($_POST['restablecer'])) {
    $idRestablecer = $_POST['id_restablecer'];
    generarYGuardarCodigoRestablecimiento($conexion, $idRestablecer);
}

$usuarios = obtenerUsuarios($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Registrados</title>
    <link rel="stylesheet" href="css/usuarios.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Usuarios Registrados</h1>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>telefono</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    <th>Puesto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $key => $usuario): ?>
                <tr class="<?php echo ($key % 2 == 0) ? 'table-active' : ''; ?>">
                    <td><?php echo $usuario['idusuario']; ?></td>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><?php echo $usuario['telefono']; ?></td>
                    <td><?php echo $usuario['correo']; ?></td>
                    
                    <td>
                        <!-- Mostrar un mensaje en lugar del campo de contraseña -->
                        <span class="text-muted">Contraseña oculta</span>
                    </td>
                    <td>
                        <?php echo ($usuario['idPuesto'] == 1) ? 'Administrador' : 'Cliente'; ?>
                    </td>
                    <td>
                        <a href="editar.php?id=<?php echo $usuario['idusuario']; ?>" class="btn btn-primary">Editar</a>
                        <form method="post" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a este usuario?');">
                            <input type="hidden" name="id_eliminar" value="<?php echo $usuario['idusuario']; ?>">
                            <button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
                        </form>
                        <!-- Agregar botón para restablecer contraseña -->
                        <form method="post">
                            <input type="hidden" name="id_restablecer" value="<?php echo $usuario['idusuario']; ?>">
                            <button type="submit" name="restablecer" class="btn btn-warning">Restablecer Contraseña</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="admin.php" class="btn btn-secondary">Volver a Admin</a>
    </div>

    <script>
        // No necesitas la función mostrarPassword para este caso
    </script>
</body>
</html>
