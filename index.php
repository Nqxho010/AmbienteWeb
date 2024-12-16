<?php 

$titulo = 'Inicio';
require_once './views/layout/head.php';
require_once './views/layout/header.php';
require_once './model/db.php';
require_once './model/emprendimiento.php';
require_once './model/categoria.php';

try {
    // Inicializar los modelos
    $emprendimientoModel = new Emprendimiento($conn);
    $categoriaModel = new Categoria($conn); 
} catch (Exception $e) {
    die("Error al inicializar los modelos: " . $e->getMessage());
}

// Verificar si hay un filtro de categoría
$categoria = isset($_GET['categoria']) && is_numeric($_GET['categoria']) ? intval($_GET['categoria']) : null;

try {
    // Obtener los emprendimientos según la categoría
    if ($categoria) {
        $emprendimientos = $emprendimientoModel->obtenerEmprendimientosPorCategoria($categoria);
    } else {
        $emprendimientos = $emprendimientoModel->obtenerEmprendimientosDestacados(8); // Limitar a 8
    }

    // Obtener todas las categorías
    $categorias = $categoriaModel->obtenerTodasLasCategorias();
} catch (Exception $e) {
    $emprendimientos = [];
    $categorias = [];
    error_log("Error al cargar los datos: " . $e->getMessage());
}
?>

<div class="bienvenida">
    <h2 class="bienvenida__titulo">Bienvenidos a la mejor feria virtual de CR</h2>
    <p class="bienvenida__texto">
        Te damos la bienvenida a una feria virtual donde el espíritu emprendedor de Costa Rica brilla en cada rincón. 
        Aquí, emprendedores locales de todo el país tienen la oportunidad de mostrar y vender sus productos, acercándolos a personas 
        como tú que valoran lo hecho con pasión y dedicación.
        Únete a nosotros para apoyar el crecimiento de pequeños negocios que sueñan en grande. 
        Con cada compra, no solo te llevas un producto de calidad, sino que también ayudas a construir un país donde el emprendimiento puede prosperar.
    </p>
</div>

<div class="filtros">
    <form class="filtros__formulario" method="GET" action="index.php">
        <label for="categoria" class="filtros__label">Filtrar por categoría:</label>
        <select name="categoria" id="categoria" class="filtros__select">
            <option value="">Todas las categorías</option>
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= htmlspecialchars($cat['id_categoria']) ?>" 
                        <?= $categoria === intval($cat['id_categoria']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['detalle']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="boton-verde">Aplicar Filtro</button>
    </form>
</div>

<div class="emprendimientos-destacados">
    <h3 class="emprendimientos-destacados__titulo">Emprendimientos destacados</h3>
    <div class="emprendimientos-destacados__grupo">
        <?php if (empty($emprendimientos)): ?>
            <p>No hay emprendimientos para mostrar en este momento.</p>
        <?php else: ?>
            <?php foreach ($emprendimientos as $emprendimiento): ?>
                <div class="emprendimientos-destacados__emprendimiento">
                    <h4 class="emprendimientos-destacados__nombre"><?= htmlspecialchars($emprendimiento['nombre_emprendimiento']) ?></h4>
                    <img 
                        class="emprendimientos-destacados__img" 
                        src="<?= htmlspecialchars($emprendimiento['url_imagen_perfil']) ?>" 
                        alt="<?= htmlspecialchars($emprendimiento['nombre_emprendimiento']) ?>">
                    <p class="emprendimientos-destacados__detalle"><?= htmlspecialchars($emprendimiento['descripcion_corta']) ?></p>
                    <a href="/AmbienteWeb/detalleEmprendimiento.php?id=<?= htmlspecialchars($emprendimiento['id_emprendimiento']) ?>" class="boton-verde emprendimientos-destacados__boton" >
                        Ver detalles
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php 
require_once './views/layout/footer.php';
?>
