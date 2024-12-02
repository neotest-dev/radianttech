<?php
require "../conexion.php";

// Verifica que se haya pasado un ID de factura válido
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM factura WHERE nofactura = $id";
    
    // Ejecuta la consulta
    if (mysqli_query($conexion, $query)) {
        // Redirige directamente a ventas.php sin mostrar una alerta
        header("Location: ventas.php");
        exit();
    } else {
        // En caso de error, también redirige sin mostrar una alerta
        header("Location: ventas.php");
        exit();
    }
} else {
    // Si el ID no es válido, redirige a ventas.php
    header("Location: ventas.php");
    exit();
}

mysqli_close($conexion);
?>
