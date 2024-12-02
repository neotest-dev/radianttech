<?php
include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['producto']) || empty($_POST['precio'])) {
    $alert = '<div class="alert alert-danger" role="alert">Todos los campos son requeridos.</div>';
  } else {
    $codproducto = $_GET['id'];
    $proveedor = $_POST['proveedor'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $query_update = mysqli_query($conexion, "UPDATE producto SET descripcion = '$producto', proveedor= $proveedor,precio= $precio WHERE codproducto = $codproducto");
    if ($query_update) {
      $alert = '<div class="alert alert-success" role="alert">Producto Modificado</div>';
    } else {
      $alert = '<div class="alert alert-danger" role="alert">Error al modificar.</div>';
    }
  }
}

// Validar producto

if (empty($_REQUEST['id'])) {
  header("Location: lista_productos.php");
} else {
  $id_producto = $_REQUEST['id'];
  if (!is_numeric($id_producto)) {
    header("Location: lista_productos.php");
  }
  $query_producto = mysqli_query($conexion, "SELECT p.codproducto, p.descripcion, p.precio, pr.codproveedor, pr.proveedor FROM producto p INNER JOIN proveedor pr ON p.proveedor = pr.codproveedor WHERE p.codproducto = $id_producto");
  $result_producto = mysqli_num_rows($query_producto);

  if ($result_producto > 0) {
    $data_producto = mysqli_fetch_assoc($query_producto);
  } else {
    header("Location: lista_productos.php");
  }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Producto</h1>
      </div>
  <div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card-body">
          <form action="" method="post">
            <?php echo isset($alert) ? $alert : ''; ?>
            <div class="form-group">
              <label for="nombre">Proveedor</label>
              <?php $query_proveedor = mysqli_query($conexion, "SELECT * FROM proveedor ORDER BY proveedor ASC");
              $resultado_proveedor = mysqli_num_rows($query_proveedor);
              mysqli_close($conexion);
              ?>
              <select id="proveedor" name="proveedor" class="form-control">
                <option value="<?php echo $data_producto['codproveedor']; ?>" selected><?php echo $data_producto['proveedor']; ?></option>
                <?php
                if ($resultado_proveedor > 0) {
                  while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                    // code...
                ?>
                    <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>
                <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="producto">Producto</label>
              <input type="text" class="form-control" placeholder="Ingrese nombre del producto" name="producto" id="producto" value="<?php echo $data_producto['descripcion']; ?>">

            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="text" placeholder="Ingrese precio" class="form-control" name="precio" id="precio" value="<?php echo $data_producto['precio']; ?>">

            </div>
            <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Editar Producto
                    </button>
                    <a href="lista_productos.php" class="btn btn-danger">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </a>
          </form>
        </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>

<script>
    // Validación en tiempo real para solo permitir números y punto
    document.getElementById('precio').addEventListener('input', function(e) {
        var value = e.target.value;

        // Reemplazar todo lo que no sea un número o un punto
        e.target.value = value.replace(/[^0-9.]/g, ''); // Permitir solo números y punto
    });
</script>

