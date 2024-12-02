<?php
session_start();

// Verificar si la sesión está activa
if (empty($_SESSION['active'])) {
    header('Location: login.php');  // Redirigir al login si la sesión no está activa
    exit;
}

// Incluir la conexión a la base de datos
include "../conexion.php";

// Obtener el ID del usuario desde la sesión
$idusuario = $_SESSION['idUser'];  // Usando el ID almacenado en la sesión

// Inicializar variables de alerta
$alert = "";

// Si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($correo) || empty($usuario)) {
        $alert = '<div class="alert alert-danger" role="alert">Todos los campos son requeridos.</div>';
    } else {
        // Actualizar los datos del usuario en la base de datos
        $sql_update = mysqli_query($conexion, "UPDATE usuario SET nombre = '$nombre', correo = '$correo', usuario = '$usuario' WHERE idusuario = '$idusuario'");

        // Verificar si la actualización fue exitosa
        if ($sql_update) {
            // Actualizar los datos en la sesión para reflejar los cambios
            $_SESSION['nombre'] = $nombre;
            $_SESSION['email'] = $correo;
            $_SESSION['user'] = $usuario;

            $alert = '<div class="alert alert-success" role="alert">Perfil actualizado correctamente.</div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">Error al actualizar los datos.</div>';
        }
    }
}

// Obtener los datos actuales del perfil del usuario
$sql = mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = '$idusuario'");
$data = mysqli_fetch_array($sql);

// Verificar si se obtuvieron los datos correctamente
if ($data) {
    $nombre = $data['nombre'];
    $correo = $data['correo'];
    $usuario = $data['usuario'];
} else {
    echo "Usuario no encontrado.";
    exit;
}
include_once "includes/header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <h1 class="h3 mb-4 text-gray-800">Editar Perfil</h1>
            <form action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>  <!-- Mostrar alerta de errores o éxito -->

                <!-- Campo para editar el nombre -->
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required>
                </div>

                <!-- Campo para editar el correo -->
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" name="correo" id="correo" value="<?php echo $correo; ?>" required>
                </div>

                <!-- Campo para editar el nombre de usuario -->
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario; ?>" required>
                </div>

                <!-- Botón para guardar los cambios -->
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>
                <a href="index.php" class="btn btn-danger">
                        <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </form>
        </div>
    </div>
</div>
<!-- End of Page Content -->

<?php include_once "includes/footer.php"; ?>
