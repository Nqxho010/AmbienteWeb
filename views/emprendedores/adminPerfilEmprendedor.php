<?php
$titulo = 'Perfil de Emprendedor';
require_once '../layout/head.php';
require_once '../layout/header.php';
require_once '../../model/emprendimiento.php';
require_once '../../model/db.php';
require_once '../../model/provincia.php';


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

$nombreProvincia = '';
foreach ($provincias as $prov) {
    if ($prov['id_provincia'] == $emprendimiento['id_provincia']) {
        $nombreProvincia = $prov['detalle'];
        break;
    }
}
?>

<div class="perfil-emprendimiento">
    <img class="perfil-emprendimiento__img" src="<?= htmlspecialchars($emprendimiento['url_imagen_perfil']) ?>" alt="Imagen del emprendimiento">

    <div class="perfil-emprendimiento__group-info">
        <h2 class="perfil-emprendimiento__nombre"><?= htmlspecialchars($emprendimiento['nombre_emprendimiento']) ?></h2>
        <p class="perfil-emprendimiento__descripcion-corta"><strong>Descripción breve:</strong> <?= htmlspecialchars($emprendimiento['descripcion_corta']) ?></p>
        <p class="perfil-emprendimiento__descripcion-larga"><strong>Descripción completa:</strong> <?= htmlspecialchars($emprendimiento['descripcion_larga']) ?></p>
        <p class="perfil-emprendimiento__telefono"><strong>Teléfono:</strong> <?= htmlspecialchars($emprendimiento['telefono']) ?></p>
        <p class="perfil-emprendimiento__provincia"><strong>Provincia:</strong> <?= htmlspecialchars($nombreProvincia) ?></p>
        <p class="perfil-emprendimiento__direccion"><strong>Detalle de dirección:</strong> <?= htmlspecialchars($emprendimiento['detalle_direccion']) ?></p>
    </div>
    <div class="perfil-emprendimiento__boton">
        <a class="boton-verde" href="./adminPerfilEmprendedorEdit.php">Modificar</a>
    </div>
</div>

<?php
require_once '../layout/footer.php';
?>
