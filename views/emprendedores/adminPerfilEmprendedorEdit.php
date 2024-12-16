<?php
$titulo = 'Editar Perfil de Emprendedor';
require_once '../layout/head.php';
require_once '../layout/header.php';
require_once '../../model/provincia.php';
require_once '../../model/emprendimiento.php';
require_once '../../model/db.php';



if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['idEmprendimiento'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión");
    exit;
}

$idEmprendimiento = $_SESSION['idEmprendimiento'];

$emprendimientoModel = new Emprendimiento($conn);
$emprendimiento = $emprendimientoModel->obtenerDetalleEmprendimiento($idEmprendimiento);

if (!$emprendimiento) {
    die("Error: No se encontró información del emprendimiento.");
}

$provinciaModel = new Provincia($conn);
$provincias = $provinciaModel->obtenerProvincias();
?>
<!-- ==================================================================== -->

<div class="perfil-emprendimiento">
    <form action="/AmbienteWeb/controller/editarEmprendimiento.php" method="POST">
        <div class="perfil-emprendimiento__grid">
            <!-- Imagen -->
            <div class="perfil-emprendimiento__group-info">
                <label for="url-imagen" class="perfil-emprendimiento__label">URL de la Imagen</label>
                <input id="url-imagen" name="url_imagen" class="perfil-emprendimiento__input" type="text"
                    value="<?= htmlspecialchars($emprendimiento['url_imagen_perfil']) ?>" required>
            </div>

            <!-- Información básica -->
            <div class="perfil-emprendimiento__group-info">
                <label for="nombre-emprendimiento" class="perfil-emprendimiento__label">Nombre del Emprendimiento</label>
                <input id="nombre-emprendimiento" name="nombre_emprendimiento" class="perfil-emprendimiento__input"
                    type="text" value="<?= htmlspecialchars($emprendimiento['nombre_emprendimiento']) ?>" required>

                <label for="descripcion-corta" class="perfil-emprendimiento__label">Descripción Corta</label>
                <input id="descripcion-corta" name="descripcion_corta" class="perfil-emprendimiento__input" type="text"
                    value="<?= htmlspecialchars($emprendimiento['descripcion_corta']) ?>" required>

                <label for="descripcion-larga" class="perfil-emprendimiento__label">Descripción Larga</label>
                <textarea id="descripcion-larga" name="descripcion_larga" class="perfil-emprendimiento__textarea" rows="5"
                    required><?= htmlspecialchars($emprendimiento['descripcion_larga']) ?></textarea>
            </div>

            <!-- Información de contacto y ubicación -->
            <div class="perfil-emprendimiento__group-info">
                <label for="telefono" class="perfil-emprendimiento__label">Teléfono</label>
                <input id="telefono" name="telefono" class="perfil-emprendimiento__input" type="text"
                    value="<?= htmlspecialchars($emprendimiento['telefono']) ?>" required>

                <label for="provincia" class="perfil-emprendimiento__label">Provincia</label>
                <select id="provincia" name="id_provincia" class="perfil-emprendimiento__select" required>
                    <option value="">Seleccione una provincia</option>
                    <?php foreach ($provincias as $provincia): ?>
                        <option value="<?= htmlspecialchars($provincia['id_provincia']) ?>"
                            <?= $provincia['id_provincia'] == $emprendimiento['id_provincia'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($provincia['detalle']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="detalle-direccion" class="perfil-emprendimiento__label">Detalle de Dirección</label>
                <textarea id="detalle-direccion" name="detalle_direccion" class="perfil-emprendimiento__textarea"
                    rows="3" required><?= htmlspecialchars($emprendimiento['detalle_direccion']) ?></textarea>
            </div>
        </div>

        <!-- Botón de guardar -->
        <div class="perfil-emprendimiento__boton">
            <button type="submit" class="boton-verde">Guardar cambios</button>
        </div>
    </form>
</div>

<?php
require_once '../layout/footer.php';
?>
