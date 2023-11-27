<?php
require_once('conexion.php');

// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}

$usuario = array('nombre' => '', 'telefono' => '', 'correo' => ''); // Inicializa el array para evitar el error

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        
        $consulta = "UPDATE persona SET nombre = '$nombre', telefono = '$telefono', correo = '$correo' WHERE idpersona = $id";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            // Redireccionar al usuario a la tabla de personas
            header('Location: agregar.php');
            exit; // Asegura que la redirección se efectúe
        } else {
            echo "Error al modificar el usuario: " . mysqli_error($conexion);
        }
    }

    $consulta = "SELECT * FROM persona WHERE idpersona = $id";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
    } else {
        echo "Usuario no encontrado.";
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modificar Usuario</title>
    <style>
        body {
            text-align: center;
            margin-top: 50px;
        }

        table {
            margin: auto;
            width: 50%;
        }

        form {
            margin-top: 20px;
        }

        .btn-primary {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>Modificar Usuario</h1>
    <form method="post" action="">
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>"></td>
                    <td><input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>"></td>
                    <td><input type="text" name="correo" value="<?php echo $usuario['correo']; ?>"></td>
                </tr>
            </tbody>
        </table>

        <input type="submit" value="Guardar cambios" class="btn btn-primary">
    </form>
</body>

</html>
