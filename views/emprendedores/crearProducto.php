<?php
require_once '../../model/db.php';
require_once '../../model/categoria.php';

$titulo = 'Crear Producto';
require_once '../layout/head.php';
require_once '../layout/header.php';


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
    <h1 class="crear-producto__titulo">Crear Producto</h1>
    <form action="/AmbienteWeb/controller/crearProducto.php" method="POST" class="crear-producto__form">
        <div class="crear-producto__group">
            <label for="nombreProducto">Nombre:</label>
            <input type="text" name="nombreProducto" id="nombreProducto" required>
        </div>

        <div class="crear-producto__group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="5" required></textarea>
        </div>

        <div class="crear-producto__group">
            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" step="0.01" required>
        </div>

        <div class="crear-producto__group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" required>
        </div>

        <div class="crear-producto__group">
            <label for="idCategoria">Categoría:</label>
            <select name="idCategoria" id="idCategoria" required>
                <option value="">Selecciona una categoría</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= htmlspecialchars($categoria['id_categoria']) ?>">
                        <?= htmlspecialchars($categoria['detalle']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="crear-producto__group">
            <label for="imagen">Imagen (URL):</label>
            <input type="text" name="imagen" id="imagen" required>
            <div class="crear-producto__preview">
                <img id="preview-imagen" src="https://ecommerce.navasola.com/assets/images/image-not-found.png" alt="Vista previa del producto" style="max-width: 200px; max-height: 200px; object-fit: cover; margin-top: 10px;">
            </div>
        </div>

        <button type="submit" class="boton-verde crear-producto__boton">Crear Producto</button>
    </form>
</div>

<script>
document.getElementById('imagen').addEventListener('input', function() {
    const url = this.value.trim();
    const preview = document.getElementById('preview-imagen');
    if (url) {
        preview.src = url;
    } else {
        preview.src = 'https://ecommerce.navasola.com/assets/images/image-not-found.png';
    }
});
</script>

<?php
require_once '../layout/footer.php';
?>
