<?php
// Incluye la conexión a la base de datos y verifica la sesión del usuario
include "conexion.php";


// Función para obtener la lista de usuarios desde la base de datos
function obtenerUsuarios($conexion) {
    $query = "SELECT * FROM usuario";
    $resultado = mysqli_query($conexion, $query);
    $usuario = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    return $usuario;
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

if (isset($_POST['eliminar'])) {
    $idEliminar = $_POST['id_eliminar'];
    eliminarUsuario($conexion, $idEliminar);
}

if (isset($_POST['actualizar_puesto'])) {
    $idActualizar = $_POST['id_actualizar'];
    $nuevoPuesto = $_POST['nuevo_puesto'];
    actualizarPuesto($conexion, $idActualizar, $nuevoPuesto);
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
    <style>
        /* Define tus propios estilos CSS aquí */
        .mi-tabla {
            background-color: #FF0404; /* Cambia el color de fondo de la tabla */
        }

        .mi-fila-par {
            background-color: #dcdcdc; /* Cambia el color de fondo de las filas pares */
        }

        .mi-fila-impar {
            background-color: #dcdcdc; /* Cambia el color de fondo de las filas impares */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Usuarios Registrados</h1>
        <table class="table table-striped mi-tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    <th>Puesto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $key => $usuario): ?>
                <tr class="<?php echo ($key % 2 == 0) ? 'mi-fila-par' : 'mi-fila-impar'; ?>">
                    <td><?php echo $usuario['idusuario']; ?></td>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><?php echo $usuario['correo']; ?></td>
                    
                    <td>
                        <div class="input-group">
                            <input type="password" class="form-control" value="<?php echo $usuario['contraseña']; ?>" id="password-<?php echo $usuario['idusuario']; ?>" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="mostrarPassword(<?php echo $usuario['idusuario']; ?>)">
                                    Mostrar
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php echo ($usuario['idPuesto'] == 1) ? 'Administrador' : 'Cliente'; ?>
                    </td>
                    <td>
                        <a href="editarusuarios.php?id=<?php echo $usuario['idusuario']; ?>" class="btn btn-primary">Editar</a>
                        <form method="post" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a este usuario?');">
                            <input type="hidden" name="id_eliminar" value="<?php echo $usuario['idusuario']; ?>">
                            <button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="admin.php" class="btn btn-secondary">Volver a Admin</a>
    </div>

    <script>
        function mostrarPassword(id) {
            var passwordField = document.getElementById("password-" + id);

            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>
</html>
