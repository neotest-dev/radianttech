<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reporte de Ventas</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "../conexion.php";
                        $query = mysqli_query($conexion, "SELECT nofactura, fecha, codcliente, totalfactura, estado FROM factura ORDER BY nofactura DESC");
                        mysqli_close($conexion);
                        $cli = mysqli_num_rows($query);

                        // Asegurarse de que el rol esté en la sesión
                        $rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : 0; // Asumimos 0 como valor por defecto en caso de que no exista el rol

                        if ($cli > 0) {
                            while ($dato = mysqli_fetch_array($query)) {
                        ?>
                                <tr>
                                    <td><?php echo $dato['nofactura']; ?></td>
                                    <td><?php echo $dato['fecha']; ?></td>
                                    <td><?php echo $dato['totalfactura']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary view_factura" cl="<?php echo $dato['codcliente']; ?>" f="<?php echo $dato['nofactura']; ?>">
                                            <i class="fas fa-eye"></i> Ver
                                        </button>
                                        
                                        <?php if ($rol != 2) { ?>
                                            <button type="button" class="btn btn-danger delete_factura" data-id="<?php echo $dato['nofactura']; ?>" data-toggle="modal" data-target="#confirmDeleteModal">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas eliminar esta factura?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript para manejar el modal -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    let facturaId;

    // Captura el ID de la factura al hacer clic en el botón Eliminar
    document.querySelectorAll('.delete_factura').forEach(button => {
        button.addEventListener('click', function() {
            facturaId = this.getAttribute('data-id');
        });
    });

    // Maneja la confirmación de eliminación
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (facturaId) {
            window.location.href = `eliminar_factura.php?id=${facturaId}`;
        }
    });
});
</script>

<?php include_once "includes/footer.php"; ?>
