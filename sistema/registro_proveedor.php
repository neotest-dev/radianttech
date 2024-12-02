<?php
include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                        Todos los campos son obligatorios
                    </div>';
    } else {
        $proveedor = $_POST['proveedor'];
        $contacto = $_POST['contacto'];
        $telefono = $_POST['telefono'];
        $Direccion = $_POST['direccion'];
        $usuario_id = $_SESSION['idUser'];
        $query = mysqli_query($conexion, "SELECT * FROM proveedor where contacto = '$contacto'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                        El Ruc ya esta registrado
                    </div>';
        }else{
        

        $query_insert = mysqli_query($conexion, "INSERT INTO proveedor(proveedor,contacto,telefono,direccion,usuario_id) values ('$proveedor', '$contacto', '$telefono', '$Direccion','$usuario_id')");
        if ($query_insert) {
            $alert = '<div class="alert alert-primary" role="alert">
                        Proveedor Registrado
                    </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                       Error al registrar proveedor
                    </div>';
        }
        }
    }
}
mysqli_close($conexion);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Registrar proveedor</h1>  
        </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
                <form action="" autocomplete="off" method="post" class="card-body p-2">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="form-group">
                        <label for="nombre">NOMBRE:</label>
                        <input type="text" placeholder="Ingrese nombre" name="proveedor" id="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contacto">RUC:</label>
                        <input type="text" 
                            placeholder="Ingrese RUC" 
                            name="contacto" 
                            id="contacto" 
                            class="form-control" 
                            maxlength="11" 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);" 
                            required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">TELÉFONO:</label>
                        <input type="text" 
                        placeholder="Ingrese teléfono" 
                        name="telefono" 
                        id="telefono" 
                        class="form-control" 
                        maxlength="9" 
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9);" 
                        required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">DIRECCIÓN:</label>
                        <input type="text" placeholder="Ingrese Direccion" name="direccion" id="direcion" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Proveedor
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