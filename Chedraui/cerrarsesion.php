<?php
// Inicia la sesión
session_start();

// Libera todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Redirige a la página de inicio o a donde prefieras
header("Location: index.php");
exit();

?>
