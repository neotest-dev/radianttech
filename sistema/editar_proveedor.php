<?php
include "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
    $alert = '<div class="alert alert-danger" role="alert">Todos los campos son requeridos.</div>';
  } else {
    $idproveedor = $_GET['id'];
    $proveedor = $_POST['proveedor'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql_update = mysqli_query($conexion, "UPDATE proveedor SET proveedor = '$proveedor', contacto = '$contacto' , telefono = $telefono, direccion = '$direccion' WHERE codproveedor = $idproveedor");

    if ($sql_update) {
      $alert = '<div class="alert alert-success" role="alert">Proveedor Actualizado correctamente</div>';
    } else {
      $alert = '<div class="alert alert-danger" role="alert">Error al actualizar proveedor.</div>';
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_proveedor.php");
  mysqli_close($conexion);
}
$idproveedor = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM proveedor WHERE codproveedor = $idproveedor");
mysqli_close($conexion);
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_proveedor.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idproveedor = $data['codproveedor'];
    $proveedor = $data['proveedor'];
    $contacto = $data['contacto'];
    $telefono = $data['telefono'];
    $direccion = $data['direccion'];
  }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Editar proveedor</h1>  
        </div>  
  <div class="row">
    <div class="col-lg-6 m-auto">
      <?php echo isset($alert) ? $alert : ''; ?>
      <form class="" action="" method="post">
        <input type="hidden" name="id" value="<?php echo $idproveedor; ?>">
        <div class="form-group">
          <label for="proveedor">Proveedor</label>
          <input type="text" placeholder="Ingrese proveedor" name="proveedor" class="form-control" id="proveedor" value="<?php echo $proveedor; ?>">
        </div>
        <div class="form-group">
          <label for="contacto">RUC</label>
          <input 
            type="text" 
            placeholder="Ingrese contacto" 
            name="contacto" 
            class="form-control" 
            id="contacto" 
            maxlength="11" 
            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);" 
            value="<?php echo isset($contacto) ? $contacto : ''; ?>">
        </div>

        <div class="form-group">
          <label for="telefono">Teléfono</label>
          <input 
            type="text" 
            placeholder="Ingrese Teléfono" 
            name="telefono" 
            class="form-control" 
            id="telefono" 
            maxlength="9" 
            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);" 
            value="<?php echo isset($telefono) ? $telefono : ''; ?>">
        </div>

        <div class="form-group">
          <label for="direccion">Dirección</label>
          <input type="text" placeholder="Ingrese Direccion" name="direccion" class="form-control" id="direccion" value="<?php echo $direccion; ?>">
        </div>
        
        <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Editar Proveedor
                    </button>
                    <a href="lista_proveedor.php" class="btn btn-danger">
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