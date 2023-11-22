<?php
require_once('conexion.php');

// Verificar si se estableció una conexión
if (!$conexion) {
    die("No se pudo conectar a la base de datos.");
}

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
<html>
<head>
    <title>Modificar Usuario</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <h1>Modificar Usuario</h1>
    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>"><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" value="<?php echo $usuario['telefono']; ?>"><br>

        <label for="correo">Correo:</label>
        <input type="text" name="correo" value="<?php echo $usuario['correo']; ?>"><br>

        <input type="submit" value="Guardar cambios">
    </form>
</body>
</html>

