<?php
require_once '../../model/db.php'; 
require_once '../../model/producto.php';
require_once '../../model/categoria.php';

try {
    $productoModel = new Producto($conn);
    $categoriaModel = new Categoria($conn); 
} catch (Exception $e) {
    die("Error al inicializar los modelos: " . $e->getMessage());
}

$categoria = isset($_GET['categoria']) && is_numeric($_GET['categoria']) ? intval($_GET['categoria']) : null;

// Obtiene los productos
try {
    if ($categoria) {
        $productos = $productoModel->obtenerProductosPorCategoria($categoria);
    } else {
        $productos = $productoModel->obtenerTodosLosProductos();
    }
} catch (Exception $e) {
    $productos = [];
    error_log("Error al obtener productos: " . $e->getMessage());
}

// Obtiene todas las categorías
try {
    $categorias = $categoriaModel->obtenerTodasLasCategorias();
} catch (Exception $e) {
    $categorias = [];
    error_log("Error al obtener categorías: " . $e->getMessage());
}

// Título de la página
$titulo = 'Productos';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>

<div class="filtros">
    <form class="filtros__formulario" method="GET" action="productos.php">
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

<div class="productos">
    <div class="productos__grupo">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="productos__item">
                    <h4 class="productos__nombre"><?= htmlspecialchars($producto['nombre_producto']) ?></h4>
                    <img class="productos__img" 
                        src="<?= htmlspecialchars($producto['url_imagen']) ?>" 
                        alt="<?= htmlspecialchars($producto['nombre_producto']) ?>">
                    <p class="productos__detalle"><?= htmlspecialchars($producto['descripcion']) ?></p>
                    <p class="productos__precio">Precio: ₡<?= number_format($producto['precio'], 2) ?></p>
                    <a href="detallesProducto.php?idProducto=<?= htmlspecialchars($producto['id_producto']) ?>" class="boton-verde">Ver detalles</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron productos.</p>
        <?php endif; ?>
    </div>
</div>
<?php
require_once '../layout/footer.php';
?>
