<?php
$titulo = 'Emprendimientos';
require_once '../layout/head.php';
require_once '../layout/header.php';
require_once '../../model/db.php';
require_once '../../model/emprendimiento.php';
require_once '../../model/categoria.php';


$categoriaModel = new Categoria();
$categorias = $categoriaModel->obtenerTodasLasCategorias();

$cantidad = isset($_GET['cantidad']) ? (int)$_GET['cantidad'] : 8;
if ($cantidad <= 0 || $cantidad > 25) {
    $cantidad = 8; 
}

$idCategoriaSeleccionada = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;


$emprendimientoModel = new Emprendimiento($conn);


if ($idCategoriaSeleccionada > 0) {
    $emprendimientos = $emprendimientoModel->obtenerEmprendimientosPorCategoria($idCategoriaSeleccionada, $cantidad);
} else {
    $emprendimientos = $emprendimientoModel->obtenerEmprendimientosDestacados($cantidad);
}
?>

<div class="main-cont">
    <form method="GET" class="main-cont__form" style="display: flex; gap: 10px; align-items: center; margin-bottom: 20px;">
        <select class="main-cont__dropdown" name="categoria">
            <option value="0" <?= $idCategoriaSeleccionada === 0 ? 'selected' : '' ?>>Elija una categoría...</option>
            <?php if ($categorias): ?>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= htmlspecialchars($cat['id_categoria']) ?>"
                        <?= ($cat['id_categoria'] == $idCategoriaSeleccionada) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['detalle']) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <div>
            <label for="cantidad">Numero de emprendimientos para mostrar:</label>
            <input type="number" id="cantidad" name="cantidad" value="<?= htmlspecialchars($cantidad) ?>" 
                   min="1" max="25" required>
        </div>

        <button type="submit" class="boton-verde">Aplicar</button>
    </form>

    <div class="main-cont__emprendimientos">
        <?php if (!empty($emprendimientos)): ?>
            <?php foreach ($emprendimientos as $emp): ?>
                <div class="emprendimiento">
                    <img class="emprendimiento__img"
                         src="<?= htmlspecialchars($emp['url_imagen_perfil']) ?>"
                         alt="Imagen de <?= htmlspecialchars($emp['nombre_emprendimiento']) ?>">
                    <h3 class="emprendimiento__nombre"><?= htmlspecialchars($emp['nombre_emprendimiento']) ?></h3>
                    <p class="emprendimiento__desecripcion" style="margin-bottom:30px;"><?= htmlspecialchars($emp['descripcion_corta']) ?></p>
                    <a href='/AmbienteWeb/views/usuarios/detalleEmprendimiento.php?id=<?= urlencode($emp['id_emprendimiento']) ?>' class="boton-verde">Ver</a>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay emprendimientos disponibles en esta categoría.</p>
        <?php endif; ?>
    </div>
</div>

<?php
require_once '../layout/footer.php';
?>
