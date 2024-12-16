<?php
require_once '../../model/db.php';
require_once '../../model/categoria.php';

$titulo = 'Crear Producto';
require_once '../layout/head.php';
require_once '../layout/header.php';

// Verificar que el usuario está autenticado
if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['idEmprendimiento'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión");
    exit;
}

$idEmprendimiento = $_SESSION['idEmprendimiento'];

try {
    $categoriaModel = new Categoria();
    $categorias = $categoriaModel->obtenerTodasLasCategorias();

    if (!$categorias) {
        throw new Exception("No se pudieron cargar las categorías.");
    }
} catch (Exception $e) {
    die("Error al cargar las categorías: " . $e->getMessage());
}

?>

<div class="crear-producto">
    <h1>Crear Producto</h1>
    <form action="/AmbienteWeb/controller/crearProducto.php" method="POST">
        <label for="nombreProducto">Nombre:</label>
        <input type="text" name="nombreProducto" id="nombreProducto" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" step="0.01" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" required>

        <label for="idCategoria">Categoría:</label>
        <select name="idCategoria" id="idCategoria" required>
            <option value="">Selecciona una categoría</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= htmlspecialchars($categoria['id_categoria']) ?>">
                    <?= htmlspecialchars($categoria['detalle']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="imagen">Imagen:</label>
        <input type="text" name="imagen" id="imagen" required>

        <button type="submit" class="boton-verde">Crear Producto</button>
    </form>
</div>

<?php
require_once '../layout/footer.php';
?>
