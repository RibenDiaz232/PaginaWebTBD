<?php
session_start();

include "conexion.php";

foreach ($_SESSION['carrito'] as $productoId => $producto) {
    
    $sentencia = "insert into ventas (fecha, producto, cantidad, precio, total, idusuario) values 
    (".$producto["fecha"].",
    ".$producto["nombre"].",
    ".$producto["cantidad"].",
    ".$producto["precio"].",
    ".$producto["precio"]*$producto["cantidad"].",
    ".$producto["IdCliente"].",
    )";

    $insert = $conexion->query($sentencia);

}
echo"exito";
?>