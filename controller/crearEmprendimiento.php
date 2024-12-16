<?php
require_once '../model/db.php';
require_once '../model/emprendimiento.php';
require_once '../model/cliente.php';

session_start();

if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['idTipoUsuario'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión");
    exit;
}

$idUsuario = $_SESSION['idUsuario'];
$idTipoUsuario = $_SESSION['idTipoUsuario'];

if ($idTipoUsuario != 1) {
    header("Location: /AmbienteWeb/index.php?error=No%20estás%20autorizado%20a%20crear%20un%20emprendimiento");
    exit;
}


$nombre = $_POST['nombre'] ?? null;
$descripcionCorta = $_POST['descripcion_corta'] ?? null;
$descripcionLarga = $_POST['descripcion_larga'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$urlImagen = $_POST['url_imagen'] ?? null;
$idProvincia = $_POST['id_provincia'] ?? null;
$detalleDireccion = $_POST['detalle_direccion'] ?? null;

if (!$nombre || !$descripcionCorta || !$descripcionLarga || !$telefono || !$urlImagen || !$idProvincia || !$detalleDireccion) {
    header("Location: /AmbienteWeb/views/emprendedores/crearEmprendimiento.php?error=Todos%20los%20campos%20son%20obligatorios");
    exit;
}

try {
    $emprendimientoModel = new Emprendimiento($conn);
    $clienteModel = new Cliente($conn);
    
    $resultado = $emprendimientoModel->crearEmprendimiento($idUsuario, $nombre, $descripcionCorta, $descripcionLarga, $telefono, $urlImagen, $idProvincia, $detalleDireccion);

    if ($resultado) {
        
        $cambioTipo = $clienteModel->cambiarTipoUsuario($idUsuario, 2);

        if ($cambioTipo) {
            
            $_SESSION['idTipoUsuario'] = 2;

            
            $sql = "SELECT id_emprendimiento FROM TAB_EMPRENDIMIENTOS WHERE id_usuario = ? ORDER BY id_emprendimiento DESC LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();
            $nuevoEmprendimiento = $result->fetch_assoc();
            
            if ($nuevoEmprendimiento) {
                $_SESSION['idEmprendimiento'] = $nuevoEmprendimiento['id_emprendimiento'];
            }

            header("Location: /AmbienteWeb/views/emprendedores/adminPerfilEmprendedor.php?success=Emprendimiento%20creado%20correctamente");
        } else {
            header("Location: /AmbienteWeb/views/usuarios/crearEmprendimiento.php?error=No%20se%20pudo%20cambiar%20el%20tipo%20de%20usuario");
        }
    } else {
        header("Location: /AmbienteWeb/views/usuarios/crearEmprendimiento.php?error=No%20se%20pudo%20crear%20el%20emprendimiento");
    }

} catch (Exception $e) {
    error_log("Error al crear el emprendimiento: " . $e->getMessage());
    header("Location: /AmbienteWeb/views/usuarios/crearEmprendimiento.php?error=Error%20interno");
}
