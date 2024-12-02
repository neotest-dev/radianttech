<?php include_once "includes/header.php"; 
    include "../conexion.php";
    // Realizar la consulta para obtener los productos
    $query = "SELECT codproducto, descripcion FROM producto";
    $result = mysqli_query($conexion, $query);

    // Verificar si la consulta devuelve resultados
    if ($result) {
        // Crear un array para almacenar los productos
        $productos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $productos[] = $row;
        }
    } else {
        // Si no hay resultados, puedes manejarlo aquí
        $productos = [];
    }

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <h4 class="text-center">Información del Cliente</h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" name="form_new_cliente_venta" id="form_new_cliente_venta">
                                        <input type="hidden" name="action" value="addCliente">
                                        <input type="hidden" id="idcliente" value="1" name="idcliente" required>
                                        <div class="row">
                                            <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>DNI</label>
                                                <input type="text" name="dni_cliente" id="dni_cliente" class="form-control" maxlength="8" required>
                                            </div>



                                            </div>
                                            <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" name="nom_cliente" id="nom_cliente" class="form-control" maxlength="22" required>
                                            </div>
                                            </div>
                                            <div class="col-lg-4">
                                            <div class="form-group">
                                            <label>Teléfono</label>
                                                <input type="tel" name="tel_cliente" id="tel_cliente" class="form-control" maxlength="9" required>
                                            </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Dirreción</label>
                                                    <input type="text" name="dir_cliente" id="dir_cliente" class="form-control" maxlength="15" required>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <h4 class="text-center">Generar Venta</h4>
                            <!-- Coloca la barra de búsqueda y las acciones dentro de una fila -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-user"></i> <b>VENDEDOR</b></label>
                                        <p style="font-size: 16px; text-transform: uppercase; color: blue; font-weight: bold;">
                                            <?php echo $_SESSION['nombre']; ?>
                                        </p>
                                    </div>
                                </div>
                                <!-- Barra de búsqueda con tamaño ajustado -->
                                <div class="col-lg-6"> <!-- Ajusta el tamaño a col-lg-3 o col-md-6 para hacerlo más pequeño -->
                                    <div class="form-group">
                                        <label><b>Buscar Producto</b></label>
                                        <input type="text" id="buscar_producto" class="form-control" placeholder="Buscar producto por nombre o código" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <!-- Fila de acciones -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Acciones</label>
                                    <div id="acciones_venta" class="form-group">
                                        <a href="#" class="btn btn-danger" id="btn_anular_venta">
                                            <i class="fas fa-times"></i> Anular
                                        </a>
                                        <a href="#" class="btn btn-primary" id="btn_facturar_venta">
                                            <i class="fas fa-cart-plus"></i> Generar Venta
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="100px">Código</th>
                                            <th>Des.</th>
                                            <th>Stock</th>
                                            <th width="100px">Cantidad</th>
                                            <th class="textright">Precio</th>
                                            <th class="textright">Precio Total</th>
                                            <th>Acciones</th>
                                        </tr>
                                        <tr>
                                            <td><input type="number" name="txt_cod_producto" id="txt_cod_producto"></td>
                                            <td id="txt_descripcion">-</td>
                                            <td id="txt_existencia">-</td>
                                            <td><input type="text" name="txt_cant_producto" id="txt_cant_producto"value="0" min="1" disabled></td>
                                            <td id="txt_precio" class="textright">0.00</td>
                                            <td id="txt_precio_total" class="txtright">0.00</td>
                                            <td>
                                                <a href="#" id="add_product_venta" class="btn btn-dark" style="display: none;">
                                                    <i class="fas fa-plus"></i> Agregar
                                                </a>
                                            </td>   

                                        </tr>
                                        <tr>
                                            <th>Código</th>
                                            <th colspan="2">Descripción</th>
                                            <th>Cantidad</th>
                                            <th class="textright">Precio</th>
                                            <th class="textright">Precio Total</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalle_venta">
                                        <!-- Contenido ajax -->

                                    </tbody>

                                    <tfoot id="detalle_totales">
                                        <!-- Contenido ajax -->
                                    </tfoot>
                                </table>

                              </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <!-- Modal -->
            <div class="modal fade" id="productoNoEncontradoModal" tabindex="-1" aria-labelledby="productoNoEncontradoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productoNoEncontradoModalLabel">Producto no encontrado</h5>
                            <!-- Elimina el botón con la "X" -->
                        </div>
                        <div class="modal-body">
                            Lo siento, no se ha encontrado el producto que buscas. Por favor, verifica el código o nombre e inténtalo de nuevo.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php include_once "includes/footer.php"; ?>

            <!-- Modal de producto no encontrado -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


            <script>
                // Validación en tiempo real para solo permitir números
                document.getElementById('dni_cliente').addEventListener('input', function(e) {
                    var value = e.target.value;

                    // Reemplazar todo lo que no sea un número
                    e.target.value = value.replace(/[^0-9]/g, '').slice(0, 8); // Limitar a 8 dígitos
                });
            </script>
            <script>
                // Validación en tiempo real para solo permitir números
                document.getElementById('tel_cliente').addEventListener('input', function(e) {
                    var value = e.target.value;

                    // Reemplazar todo lo que no sea un número
                    e.target.value = value.replace(/[^0-9]/g, '').slice(0, 9); // Limitar a 9 dígitos
                });
            </script>
            <script>
                // Validación en tiempo real para solo permitir letras con tildes y espacios
                document.getElementById('nom_cliente').addEventListener('input', function(e) {
                    var value = e.target.value;

                    // Reemplazar todo lo que no sea letra (con tildes) o espacio
                    e.target.value = value.replace(/[^A-Za-zÁÉÍÓÚáéíóúñÑ\s]/g, '').slice(0, 22); // Limitar a 22 caracteres
                });
            </script>
            <script>
                document.getElementById('buscar_producto').addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        // Obtener el valor ingresado
                        var busqueda = e.target.value.trim();

                        // Comprobar si hay algo escrito en el campo
                        if (busqueda !== "") {
                            // Realizar la búsqueda usando AJAX
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', 'buscar_producto.php?search=' + encodeURIComponent(busqueda), true);
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    var producto = JSON.parse(xhr.responseText);
                                    
                                    if (producto) {
                                        // Si encontramos el producto, llenar la tabla
                                        document.getElementById('txt_cod_producto').value = producto.codproducto;
                                        document.getElementById('txt_descripcion').textContent = producto.descripcion;
                                        document.getElementById('txt_precio').textContent = producto.precio;
                                        document.getElementById('txt_existencia').textContent = producto.existencia;
                                        
                                        // Activar el campo de cantidad
                                        document.getElementById('txt_cant_producto').disabled = false;
                                    } else {
                                        $('#productoNoEncontradoModal').modal('show');
                                    }
                                } else {
                                    alert("Hubo un error al buscar el producto.");
                                }
                            };
                            xhr.send();
                        }
                    }
                });
            </script>
            <script>
                // Detecta el cambio en la cantidad
                document.getElementById('txt_cant_producto').addEventListener('input', function() {
                    var cantidad = parseFloat(this.value) || 0;  // Obtener la cantidad o 0 si está vacía
                    var precioUnitario = parseFloat(document.getElementById('txt_precio').textContent) || 0; // Obtener el precio

                    // Calcular el precio total
                    var precioTotal = cantidad * precioUnitario;

                    // Mostrar el precio total en el campo correspondiente
                    document.getElementById('txt_precio_total').textContent = precioTotal.toFixed(2); // Limitar a dos decimales
                });
            </script>
            <script type="text/javascript">
                // Espera a que el documento esté listo
                document.getElementById('form_new_cliente_venta').addEventListener('submit', function(event) {
                    // Prevenir el envío del formulario
                    event.preventDefault();

                    // Obtener los valores de los campos
                    var dni = document.getElementById('dni_cliente').value;
                    var nombre = document.getElementById('nom_cliente').value;
                    var telefono = document.getElementById('tel_cliente').value;
                    var direccion = document.getElementById('dir_cliente').value;

                    // Validación: verificar que no estén vacíos
                    if (dni === "" || nombre === "" || telefono === "" || direccion === "") {
                        // Si algún campo está vacío, mostrar un mensaje de alerta
                        alert("Todos los campos son obligatorios. Por favor, complete los campos antes de generar la venta.");
                    } else {
                        // Si todos los campos tienen datos, enviar el formulario
                        this.submit();
                    }
                });
            </script>



