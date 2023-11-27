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
    <!-- Agrega las clases de Bootstrap para el estilo -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="text-center">
    <h1 class="mt-5">Modificar Usuario</h1>
    <form method="post" action="" class="mt-5">
        <!-- Utiliza las clases de Bootstrap para centrar y dar estilo a la tabla -->
        <table class="table mx-auto w-50">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombre del Usuario</th>
                    <th scope="col">Número de teléfono</th>
                    <th scope="col">Correo electrónico</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" class="form-control"></td>
                    <td><input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>" class="form-control"></td>
                    <td><input type="text" name="correo" value="<?php echo $usuario['correo']; ?>" class="form-control"></td>
                </tr>
            </tbody>
        </table>

        <!-- Utiliza las clases de Bootstrap para centrar y dar estilo al botón -->
        <input type="submit" value="Guardar cambios" class="btn btn-primary mt-3">
    </form>

    <!-- Incluye el script de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.co
