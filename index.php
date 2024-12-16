<?php 

$titulo = 'Inicio';
require_once './views/layout/head.php';
require_once './views/layout/header.php';
require_once './model/db.php';
require_once './model/emprendimiento.php';

try {
    // Pasar la conexión al modelo
    $emprendimientoModel = new Emprendimiento($conn);
    $emprendimientosDestacados = $emprendimientoModel->obtenerEmprendimientosDestacados(8); // Limitar a 8
} catch (Exception $e) {
    die("Error al cargar los emprendimientos: " . $e->getMessage());
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

<div class="emprendimientos-destacados">
    <h3 class="emprendimientos-destacados__titulo">Emprendimientos destacados</h3>
    <div class="emprendimientos-destacados__grupo">
        <?php if (empty($emprendimientosDestacados)) : ?>
            <p>No hay emprendimientos destacados para mostrar en este momento.</p>
        <?php else : ?>
            <?php foreach ($emprendimientosDestacados as $emprendimiento) : ?>
                <div class="emprendimientos-destacados__emprendimiento">
                    <h4 class="emprendimientos-destacados__nombre"><?= htmlspecialchars($emprendimiento['nombre_emprendimiento']) ?></h4>
                    <img 
                        class="emprendimientos-destacados__img" 
                        src="<?= htmlspecialchars($emprendimiento['url_imagen_perfil']) ?>" 
                        alt="<?= htmlspecialchars($emprendimiento['nombre_emprendimiento']) ?>">
                    <p class="emprendimientos-destacados__detalle"><?= htmlspecialchars($emprendimiento['descripcion_corta']) ?></p>
                    <a href="/detalleEmprendimiento.php?id=<?= htmlspecialchars($emprendimiento['id_emprendimiento']) ?>" class="boton-verde emprendimientos-destacados__boton" >
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
