<?php
// Verifica si se han enviado datos desde el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    // Obtén los valores del formulario
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    // Realiza la lógica de registro (solo clientes)
    $registrationSuccess = registerUser($nombre, $correo, $usuario, $contraseña);

    if ($registrationSuccess) {
        // Redirige después del registro exitoso
        header("Location: login.php");
        exit();
    } else {
        $error_message = "Error en el registro. Inténtalo de nuevo.";
    }
}

// Función de registro (simulada, solo clientes)
function registerUser($nombre, $correo, $usuario, $contraseña) {
    // Lógica de registro simulada
    // Puedes reemplazar esto con una inserción en tu base de datos u otro sistema de registro
    // Aquí asumimos que solo los clientes pueden registrarse (puesto 2)
    $userType = 2;

    // TODO: Agregar lógica de inserción en la base de datos

    return true; // Devuelve true para indicar un registro exitoso
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <form action="" method="post" class="form">
            <h2>Registro</h2>
            <?php if (isset($error_message)): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="text" name="correo" placeholder="Correo Electrónico" required>
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <button type="submit" name="register">Registrarse</button>
        </form>
    </div>
</body>
</html>
