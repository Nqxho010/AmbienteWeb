<?php
$titulo = 'Crear Emprendimiento';
require_once '../layout/head.php';
require_once '../layout/header.php';
require_once '../../model/provincia.php';
require_once '../../model/db.php';
require_once '../../model/cliente.php';


if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['idTipoUsuario'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión");
    exit;
}

$idUsuario = $_SESSION['idUsuario'];
$idTipoUsuario = $_SESSION['idTipoUsuario']; 

// NO PERMITIR EMPRENDEDORES
if ($idTipoUsuario == 2) {
    header("Location: /AmbienteWeb/index.php?error=Ya%20eres%20emprendedor,%20no%20puedes%20crear%20otro%20emprendimiento");
    exit;
}

$provinciaModel = new Provincia($conn);
$provincias = $provinciaModel->obtenerProvincias();
?>

<div class="perfil-emprendimiento">
    <h2>Crear Nuevo Emprendimiento</h2>
    <form action="/AmbienteWeb/controller/crearEmprendimiento.php" method="POST">
        <div class="perfil-emprendimiento__group-info">
            <label for="nombre">Nombre del Emprendimiento</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="descripcion_corta">Descripción Corta</label>
            <input type="text" name="descripcion_corta" id="descripcion_corta" required>

            <label for="descripcion_larga">Descripción Larga</label>
            <textarea name="descripcion_larga" id="descripcion_larga" rows="5" required></textarea>

            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" required>

            <label for="url_imagen">URL de la Imagen</label>
            <input type="text" name="url_imagen" id="url_imagen" required>

            <label for="id_provincia">Provincia</label>
            <select name="id_provincia" id="id_provincia" required>
                <option value="">Seleccione una provincia</option>
                <?php foreach ($provincias as $provincia): ?>
                    <option value="<?= htmlspecialchars($provincia['id_provincia']) ?>">
                        <?= htmlspecialchars($provincia['detalle']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="detalle_direccion">Detalle de Dirección</label>
            <textarea name="detalle_direccion" id="detalle_direccion" rows="3" required></textarea>
        </div>

        <div class="perfil-emprendimiento__boton">
            <button type="submit" class="boton-verde">Crear Emprendimiento</button>
        </div>
    </form>
</div>

<?php
require_once '../layout/footer.php';
?>
