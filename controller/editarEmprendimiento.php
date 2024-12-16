<?php
require_once '../model/db.php';
require_once '../model/emprendimiento.php';


session_start();


if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['idEmprendimiento'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión");
    exit;
}

$idEmprendimiento = $_SESSION['idEmprendimiento'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreEmprendimiento = $_POST['nombre_emprendimiento'] ?? null;
    $descripcionCorta = $_POST['descripcion_corta'] ?? null;
    $descripcionLarga = $_POST['descripcion_larga'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $urlImagen = $_POST['url_imagen'] ?? null;
    $idProvincia = $_POST['id_provincia'] ?? null;
    $detalleDireccion = $_POST['detalle_direccion'] ?? null;

    if (!$nombreEmprendimiento || !$descripcionCorta || !$descripcionLarga || !$telefono || !$urlImagen || !$idProvincia || !$detalleDireccion) {
        header("Location: /AmbienteWeb/views/emprendedores/editarPerfil.php?error=Todos%20los%20campos%20son%20obligatorios");
        exit;
    }

    try {       
        $emprendimientoModel = new Emprendimiento($conn);

        $resultado = $emprendimientoModel->actualizarEmprendimiento(
            $idEmprendimiento,
            $nombreEmprendimiento,
            $descripcionCorta,
            $descripcionLarga,
            $telefono,
            $urlImagen,
            $idProvincia,
            $detalleDireccion
        );

        if ($resultado) {
            header("Location: /AmbienteWeb/views/emprendedores/adminPerfilEmprendedor.php?success=Perfil%20actualizado%20correctamente");
        } else {
            header("Location: /AmbienteWeb/views/emprendedores/adminPerfilEmprendedorEdit.php?error=No%20se%20pudo%20actualizar%20el%20perfil");
        }
    } catch (Exception $e) {
        error_log("Error al actualizar el perfil del emprendimiento: " . $e->getMessage());
        header("Location: /AmbienteWeb/views/emprendedores/adminPerfilEmprendedorEdit.php?error=Error%20interno%20al%20guardar%20los%20cambios");
    }
} else {
    header("Location: /AmbienteWeb/views/emprendedores/adminPerfilEmprendedorEdit.php?error=Método%20no%20permitido");
    exit;
}
?>
