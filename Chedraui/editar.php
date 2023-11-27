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

<body>
    <h1 class="text-center mt-5">Modificar Usuario</h1>
    <form method="post" action="" class="mt-5 text-center">
        <!-- Utiliza las clases de Bootstrap para centrar y dar estilo a la tabla -->
        <table class="table mx-auto w-50">
            <thead class="thead-dark">
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
                    <td><input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" cla
