<?php
include_once "includes/header.php";
include "../conexion.php";
// Validar producto

if (empty($_REQUEST['id'])) {
    header("Location: lista_productos.php");
} else {
    $id_producto = $_REQUEST['id'];
    if (!is_numeric($id_producto)) {
        header("Location: lista_productos.php");
    }
    $query_producto = mysqli_query($conexion, "SELECT codproducto, descripcion, proveedor, precio, existencia FROM producto WHERE codproducto = $id_producto");
    $result_producto = mysqli_num_rows($query_producto);

    if ($result_producto > 0) {
        $data_producto = mysqli_fetch_assoc($query_producto);
    } else {
        header("Location: lista_productos.php");
    }
}
// Agregar Productos a entrada
if (!empty($_POST)) {
    $alert = "";
    if (!empty($_POST['cantidad']) || !empty($_POST['precio']) || !empty($_POST['producto_id'])) {
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $producto_id = $_GET['id'];
        $usuario_id = $_SESSION['idUser'];
        $query_insert = mysqli_query($conexion, "INSERT INTO entradas(codproducto,cantidad,precio,usuario_id) VALUES ($producto_id, $cantidad, $precio, $usuario_id)");
        if ($query_insert) {
            // ejecutar procedimiento almacenado
            $query_upd = mysqli_query($conexion, "CALL actualizar_precio_producto($cantidad,$precio,$producto_id)");
            $result_pro = mysqli_num_rows($query_upd);
            if ($result_pro > 0) {
                $alert = '<div class="alert alert-primary" role="alert">
                        Producto actualizado con exito
                    </div>';
            }
        } else {
            echo "error";
        }
        mysqli_close($conexion);
    } else {
        echo "error";
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Actualizar Stock</h1>
    </div>
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <div class="form-group">
                    <label for="precio">Precio Actual</label>
                    <input type="number" class="form-control" value="<?php echo $data_producto['precio']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="precio">Cantidad de productos Disponibles</label>
                    <input type="number" class="form-control" value="<?php echo $data_producto['existencia']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="precio">Nuevo Precio</label>
                    <input type="text" placeholder="Ingrese nuevo precio" name="precio" class="form-control" 
                        value="<?php echo $data_producto['precio']; ?>" pattern="^\d+(\.\d{1,2})?$" title="Solo se permiten números y hasta dos decimales">
                </div>

                <div class="form-group">
                    <label for="cantidad">Agregar Cantidad</label>
                    <input type="number" placeholder="Ingrese cantidad" name="cantidad" id="cantidad" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="lista_productos.php" class="btn btn-danger">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </a>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>