<?php
session_start();
require_once './views/layout/head.php';
require_once './views/layout/header.php';
require_once './model/db.php';
require_once './model/usuario.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

try {
    $id_usuario = $_SESSION['id_usuario'];
    $usuarioModel = new Usuario($conn);

    // Obtener los detalles del usuario actual
    $usuarioDetalles = $usuarioModel->obtenerDetallesUsuario($id_usuario);

    if (!$usuarioDetalles) {
        throw new Exception("No se encontraron detalles para el usuario.");
    }

    // Si se envía el formulario, procesar la actualización
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim($_POST['nombre']);
        $apellidos = trim($_POST['apellidos']);
        $correo = trim($_POST['correo']);
        $id_provincia = intval($_POST['id_provincia']);
        $detalle_direccion = trim($_POST['detalle_direccion']);

        // Validar campos requeridos
        if (empty($nombre) || empty($apellidos) || empty($correo)) {
            $error = "Los campos Nombre, Apellidos y Correo son obligatorios.";
        } else {
            $actualizado = $usuarioModel->actualizarUsuario($id_usuario, $nombre, $apellidos, $correo, $id_provincia, $detalle_direccion);

            if ($actualizado) {
                $mensaje = "Datos actualizados correctamente.";
                $usuarioDetalles = $usuarioModel->obtenerDetallesUsuario($id_usuario); // Actualizar los datos mostrados
            } else {
                $error = "Error al actualizar los datos del usuario.";
            }
        }
    }
} catch (Exception $e) {
    die("Error al cargar la página: " . $e->getMessage());
}
?>

<div class="usuario-editar">
    <h2>Editar Usuario</h2>
    <?php if (isset($mensaje)): ?>
        <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
    <?php elseif (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuarioDetalles['nombre']) ?>" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($usuarioDetalles['apellidos']) ?>" required>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($usuarioDetalles['correo']) ?>" required>

        <label for="id_provincia">Provincia:</label>
        <select id="id_provincia" name="id_provincia" required>
            <?php
            $provincias = $usuarioModel->obtenerProvincias();
            foreach ($provincias as $provincia) {
                $selected = $provincia['id_provincia'] == $usuarioDetalles['id_provincia'] ? 'selected' : '';
                echo "<option value='{$provincia['id_provincia']}' {$selected}>{$provincia['detalle']}</option>";
            }
            ?>
        </select>

        <label for="detalle_direccion">Dirección:</label>
        <textarea id="detalle_direccion" name="detalle_direccion"><?= htmlspecialchars($usuarioDetalles['detalle_direccion']) ?></textarea>

        <button type="submit" class="boton-verde">Guardar Cambios</button>
    </form>
</div>

<?php
require_once './views/layout/footer.php';
?>
