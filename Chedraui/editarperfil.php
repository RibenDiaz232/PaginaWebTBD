<?php
session_start();

// Obtén la información del usuario desde la base de datos
$idusuario = isset($_SESSION['idusuario']) ? $_SESSION['idusuario'] : null;
$usuario = [];

if ($idusuario) {
    // Aquí debes realizar la consulta a tu base de datos para obtener los datos del usuario
    // Reemplaza con tus propias consultas y conexión a la base de datos
    include_once 'conexion.php'; // Reemplaza con el nombre de tu archivo de conexión
    // Verificar si se estableció una conexión
    if (!$conexion) {
        die("No se pudo conectar a la base de datos.");
    }
    $query = "SELECT * FROM usuario WHERE idusuario = $idusuario";
    $resultado = $conexion->query($query);

    if (!$resultado) {
        die("Error en la consulta: " . $conexion->error);
    }

    $usuario = $resultado->fetch_assoc();

    
} else {
    // Handle the case when $idusuario is not set or invalid
    echo "Usuario no válido";
    // You might also want to redirect the user to a login page
    // header("Location: login.php");
    exit;
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesa los datos del formulario
    // Aquí debes realizar las validaciones y actualizar la base de datos

    // Ejemplo: Actualiza los valores
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Verificar si se estableció una conexión
    if ($conexion->connect_error) {
        die("No se pudo conectar a la base de datos: " . $conexion->connect_error);
    }

    // Aquí debes realizar las validaciones antes de actualizar la base de datos

    // Ejemplo: Actualiza la base de datos con los nuevos valores
    $updateQuery = "UPDATE usuario SET nombre = '$nombre', telefono = '$telefono', correo = '$correo' WHERE idUsuario = $idusuario";

    if ($conexion->query($updateQuery) === TRUE) {
        // Actualización exitosa
        $mensajeExito = "Perfil actualizado con éxito";
        // Puedes actualizar la variable $usuario para que refleje los nuevos valores
        $usuario['nombre'] = $nombre;
        $usuario['telefono'] = $telefono;
        $usuario['correo'] = $correo;
    } else {
        // Error en la actualización
        $mensajeError = "Error al actualizar el perfil: " . $conexion->error;
    }

    // Cierra la conexión después de la actualización
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil y Edición</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container-section {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php if ($idusuario && $usuario): ?>
            <div class="container-section">
                <h2 class="mb-4">Perfil de <?php echo $usuario['nombre']; ?></h2>
                <p><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $usuario['telefono']; ?></p>
                <p><strong>Correo Electrónico:</strong> <?php echo $usuario['correo']; ?></p>
            </div>

            <div class="container-section">
                <h2 class="mb-4">Editar Perfil</h2>
                <?php if (isset($mensajeExito)): ?>
                    <div class="alert alert-success" role="alert" id="mensajeExito">
                        <?php echo $mensajeExito; ?>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        // Oculta el mensaje de éxito después de 5 segundos (5000 milisegundos)
                        $(document).ready(function(){
                            setTimeout(function () {
                                $("#mensajeExito").fadeOut(1000);
                            }, 5000);
                        });
                    </script>
                <?php endif; ?>
                <?php if (isset($mensajeError)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $mensajeError; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $usuario['telefono']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
