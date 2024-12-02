<?php
include "../conexion.php";

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conexion, $_GET['search']);
    
    // Realizar la consulta para buscar el producto
    $query = "SELECT codproducto, descripcion, precio, existencia FROM producto WHERE descripcion LIKE '%$search%' OR codproducto LIKE '%$search%' LIMIT 1";
    $result = mysqli_query($conexion, $query);
    
    // Verificar si encontramos algún producto
    if ($result && mysqli_num_rows($result) > 0) {
        $producto = mysqli_fetch_assoc($result);
        echo json_encode($producto);
    } else {
        echo json_encode(null); // No encontrado
    }
}
?>
