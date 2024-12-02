<?php include_once "includes/header.php"; ?>
<style>
    body {
        background-image: url('sistema/img/back.png'); /* Reemplaza con la ruta de tu imagen */
        background-size: cover; /* Ajusta la imagen para cubrir todo el fondo */
        background-position: center; /* Centra la imagen */
        background-repeat: no-repeat; /* No repite la imagen */
        margin: 0; /* Elimina el margen por defecto */
        height: 100vh; /* Asegura que el cuerpo ocupe toda la altura de la ventana */
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid container-custom">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Mostrar tarjeta de "Usuarios" solo si el rol es 1 (Administrador) -->
		<?php if ($_SESSION['rol'] == 1) { ?>
			<a class="col-xl-3 col-md-6 mb-4" href="lista_usuarios.php">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuarios</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data['usuarios']; ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-user fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</a>
		<?php } ?>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="lista_cliente.php">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Clientes</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data['clientes']; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="lista_productos.php">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Productos</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $data['productos']; ?></div>
								</div>
								<div class="col">
									<div class="progress progress-sm mr-2">
										<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-box fa-2x text-gray-300"></i> <!-- Ícono de caja para representar productos -->
						</div>

					</div>
				</div>
			</div>
		</a>

		<!-- Pending Requests Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="ventas.php">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ventas</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data['ventas']; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-shopping-cart fa-2x text-gray-300"></i> <!-- Ícono de carrito de compras -->
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	
	<!-- Content Row -->
    <div class="row">
        <!-- Card for User Info -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow border-left-primary animated fadeInUp">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-user-circle"></i> Información Personal
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Nombre:</label>
                        <p><strong><?php echo $_SESSION['nombre']; ?></strong></p>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Correo:</label>
                        <p><strong><?php echo $_SESSION['email']; ?></strong></p>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-cogs"></i> Rol:</label>
                        <p><strong><?php echo $_SESSION['rol_name']; ?></strong></p>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-id-badge"></i> Usuario:</label>
                        <p><strong><?php echo $_SESSION['user']; ?></strong></p>
                    </div>
                    <a href="#changePass" class="btn btn-warning btn-block" data-toggle="collapse"><i class="fas fa-key"></i> Cambiar Contraseña</a>
                    
                    <div id="changePass" class="collapse mt-3">
                        <form action="" method="post" name="frmChangePass" id="frmChangePass">
                            <div class="form-group">
                                <label><i class="fas fa-lock"></i> Contraseña Actual</label>
                                <input type="password" name="actual" id="actual" placeholder="Clave Actual" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-lock-open"></i> Nueva Contraseña</label>
                                <input type="password" name="nueva" id="nueva" placeholder="Nueva Clave" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-check-circle"></i> Confirmar Contraseña</label>
                                <input type="password" name="confirmar" id="confirmar" placeholder="Confirmar clave" class="form-control" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save"></i> Guardar Nueva Contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card with Motivational Message and Date -->
        <div class="col-xl-4 col-lg-4 mb-4">
            <div class="card shadow border-left-warning animated fadeInUp">
                <div class="card-header bg-warning text-white">
                    <i class="fas fa-calendar-day"></i> Mensaje del día
                </div>
                <div class="card-body">
                    <h5 class="card-title" id="date"><?php echo date('d F, Y'); ?></h5>
                    <p class="card-text">
                        <strong>"Si puedes imaginarlo, puedes programarlo. (Programación ATS)"</strong>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Card for Company Info (Conditional for Admin) -->
        <?php if ($_SESSION['rol'] == 1) { ?>
            <div class="col-xl-6 col-lg-6 mb-4">
                <div class="card shadow border-left-success animated fadeInUp">
                    <div class="card-header bg-success text-white">
                        <i class="fas fa-building"></i> Datos de la Empresa
                    </div>
                    <div class="card-body">
                        <form action="empresa.php" method="post" id="frmEmpresa">
                            <div class="form-group">
                                <label><i class="fas fa-briefcase"></i> RUC:</label>
                                <input type="number" name="txtDni" id="txtDni" placeholder="RUC de la Empresa" class="form-control" value="<?php echo $dni; ?>" required maxlength="8">
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-building"></i> Nombre:</label>
                                <input type="text" name="txtNombre" id="txtNombre" class="form-control" value="<?php echo $nombre_empresa; ?>" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-file-signature"></i> Razon Social:</label>
                                <input type="text" name="txtRSocial" id="txtRSocial" class="form-control" value="<?php echo $razonSocial; ?>" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-phone"></i> Teléfono:</label>
                                <input type="text" name="txtTelEmpresa" id="txtTelEmpresa" class="form-control" value="<?php echo $telEmpresa; ?>" 
                                    maxlength="9" oninput="validarTelefono(this)" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-envelope"></i> Correo Electrónico:</label>
                                <input type="email" name="txtEmailEmpresa" id="txtEmailEmpresa" class="form-control" value="<?php echo $emailEmpresa; ?>" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-map-marker-alt"></i> Dirección:</label>
                                <input type="text" name="txtDirEmpresa" id="txtDirEmpresa" class="form-control" value="<?php echo $dirEmpresa; ?>" required>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-percent"></i> IGV (%):</label>
                                <input type="text" name="txtIgv" id="txtIgv" class="form-control" value="<?php echo $igv; ?>" 
                                    oninput="validarIgv(this)" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> Guardar Datos</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <!-- If not Admin, show just the company data -->
            <div class="col-xl-6 col-lg-6 mb-4">
                <div class="card shadow border-left-info animated fadeInUp">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-building"></i> Datos de la Empresa
                    </div>
                    <div class="card-body">
                        <div>
                            <strong>RUC:</strong> <?php echo $dni; ?>
                        </div>
                        <div>
                            <strong>Nombre:</strong> <?php echo $nombre_empresa; ?>
                        </div>
                        <div>
                            <strong>Razon Social:</strong> <?php echo $razonSocial; ?>
                        </div>
                        <div>
                            <strong>Teléfono:</strong> <?php echo $telEmpresa; ?>
                        </div>
                        <div>
                            <strong>Correo Electrónico:</strong> <?php echo $emailEmpresa; ?>
                        </div>
                        <div>
                            <strong>Dirección:</strong> <?php echo $dirEmpresa; ?>
                        </div>
                        <div>
                            <strong>IGV (%):</strong> <?php echo $igv; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

		<!-- Card with Motivational Message and Date -->
<div class="col-xl-4 col-lg-4 mb-4">
    <div class="card shadow border-left-warning animated fadeInUp">
        <div class="card-header bg-warning text-white">
            <i class="fas fa-calendar-day"></i> Calendario
        </div>
        <div class="card-body">
			<h5 class="card-title" id="date">Mantente al día y organizado</h5>
            <p class="card-text">
                <strong></strong>
            </p>

            <!-- Calendario -->
            <div id="calendar"></div>
        </div>
    </div>
</div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include_once "includes/footer.php"; ?>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Mensaje emergente al cargar
    Swal.fire({
        title: 'Bienvenido!',
        text: '¡Bienvenido al panel de administración!',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    });

    // Validación en tiempo real para solo permitir números
    document.getElementById('txtDni').addEventListener('input', function(e) {
        var value = e.target.value;
        e.target.value = value.replace(/[^0-9]/g, '').slice(0, 11); // Limitar a 9 dígitos
    });
</script>

<style>
    /* Animación para las tarjetas */
    .animated {
        animation-duration: 1s;
    }

    .fadeInUp {
        animation-name: fadeInUp;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


</div>
<!-- End of Main Content -->

<?php include_once "includes/footer.php"; ?>

			<script>
                // Validación en tiempo real para solo permitir números
                document.getElementById('txtDni').addEventListener('input', function(e) {
                    var value = e.target.value;

                    // Reemplazar todo lo que no sea un número
                    e.target.value = value.replace(/[^0-9]/g, '').slice(0, 11); // Limitar a 9 dígitos
                });
            </script>
			<!-- Incluir las librerías de FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>

<script>
// Inicializar el calendario con FullCalendar
$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month'
        },
        events: [],
        locale: 'es', // Configura el calendario en español
    });
});
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

<script>
function validarIgv(input) {
    // Reemplaza cualquier valor no numérico y no punto
    input.value = input.value.replace(/[^0-9.]/g, '');
    
    // Asegura que solo haya un punto decimal
    if ((input.value.match(/\./g) || []).length > 1) {
        input.value = input.value.replace(/\.(?=.*\.)/, ''); // Elimina puntos adicionales
    }
}
</script>