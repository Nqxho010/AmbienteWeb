<?php
$titulo = 'Editar Dirección';
require_once '../layout/head.php';
require_once '../layout/header.php';

require_once '../../model/db.php';
require_once '../../model/cliente.php';
require_once '../../model/provincia.php';


if (!isset($_SESSION['idUsuario'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión");
    exit;
}

$idUsuario = $_SESSION['idUsuario'];
$clienteModel = new Cliente($conn);
$infoUsuario = $clienteModel->obtenerInformacionCliente($idUsuario);

if (!$infoUsuario) {
    die("Error: No se encontró información del usuario.");
}

$provinciaModel = new Provincia($conn);
$provincias = $provinciaModel->obtenerProvincias();
?>

<div class="editar-direccion">
    <h1 class="editar-direccion__titulo">Editar Dirección</h1>
    <form action="/AmbienteWeb/controller/editarDireccionUsuario.php" method="POST" class="editar-direccion__form">
        <div class="editar-direccion__group">
            <label for="id_provincia">Provincia:</label>
            <select name="id_provincia" id="id_provincia" required>
                <option value="">Seleccione una provincia</option>
                <?php foreach ($provincias as $prov): ?>
                    <option value="<?= htmlspecialchars($prov['id_provincia']) ?>"
                        <?= $prov['detalle'] == $infoUsuario['provincia'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($prov['detalle']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="editar-direccion__group">
            <label for="detalle_direccion">Detalle de Dirección:</label>
            <textarea name="detalle_direccion" id="detalle_direccion" rows="3" required><?= htmlspecialchars($infoUsuario['detalle_direccion']) ?></textarea>
        </div>

        <button type="submit" class="boton-verde editar-direccion__boton">Guardar Cambios</button>
    </form>
</div>

<?php
require_once '../layout/footer.php';
?>
