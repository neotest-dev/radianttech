<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
    $alert = '<div class="alert alert-danger" role="alert">Todos los campos son requeridos.</div>';
  } else {
    $idcliente = $_POST['id'];
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $result = 0;
    if (is_numeric($dni) and $dni != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM cliente where (dni = '$dni' AND idcliente != $idcliente)");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class"error">El dni ya existe</p>';
    } else {
      if ($dni == '') {
        $dni = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE cliente SET dni = $dni, nombre = '$nombre' , telefono = '$telefono', direccion = '$direccion' WHERE idcliente = $idcliente");

      if ($sql_update) {
        $alert = '<div class="alert alert-success" role="alert">Cliente actualizado correctamente.</div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">Error al actualizar el cliente.</div>';
      }
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_cliente.php");
}
$idcliente = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM cliente WHERE idcliente = $idcliente");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_cliente.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idcliente = $data['idcliente'];
    $dni = $data['dni'];
    $nombre = $data['nombre'];
    $telefono = $data['telefono'];
    $direccion = $data['direccion'];
  }
}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Editar Cliente</h1>
          </div>
          <div class="row">
            <div class="col-lg-6 m-auto">

              <form class="" action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $idcliente; ?>">
                <div class="form-group">
                  <label for="dni">DNI</label>
                  <input type="text" placeholder="Ingrese DNI" name="dni" id="dni" class="form-control" 
                        maxlength="8" oninput="validarDNI(this)" value="<?php echo $dni; ?>" required>
              </div>
              <div class="form-group">
                  <label for="nombre">Nombres y apellidos</label>
                  <input type="text" placeholder="Ingrese Nombre" name="nombre" class="form-control" id="nombre" 
                        value="<?php echo $nombre; ?>" oninput="validarNombre(this)" required>
              </div>
              <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="text" placeholder="Ingrese Teléfono" name="telefono" class="form-control" id="telefono" 
                        value="<?php echo $telefono; ?>" maxlength="9" oninput="validarTelefono(this)" required>
              </div>
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" placeholder="Ingrese Dirección" name="direccion" class="form-control" id="direccion" 
                      value="<?php echo $direccion; ?>" maxlength="15" required>
            </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Editar Cliente</button>
                <a href="lista_cliente.php" class="btn btn-danger">
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

      <script>
function validarDNI(input) {
    // Elimina cualquier valor no numérico
    input.value = input.value.replace(/[^0-9]/g, '');

    // Limita a 8 dígitos
    if (input.value.length > 8) {
        input.value = input.value.slice(0, 8);
    }
}
</script>

<script>
function validarNombre(input) {
    // Reemplaza cualquier valor que no sea una letra o espacio
    input.value = input.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
}
</script>

<script>
function validarTelefono(input) {
    // Elimina cualquier valor que no sea un número
    input.value = input.value.replace(/[^0-9]/g, '');

    // Limita a 9 dígitos
    if (input.value.length > 9) {
        input.value = input.value.slice(0, 9); // Recorta a 9 caracteres
    }
}
</script>