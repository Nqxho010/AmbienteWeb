
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../model/cliente.php';

    // Obtener datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $password = $_POST['password'] ?? '';
    $id_provincia = $_POST['id_provincia'] ?? '';
    $detalle_direccion = $_POST['detalle_direccion'] ?? '';

    // Validaciones básicas
    if (empty($nombre) || empty($apellidos) || empty($correo) || empty($password) || empty($id_provincia) || empty($detalle_direccion)) {
        header("Location: /AmbienteWeb/views/registro.php?error=Datos%20incompletos");
        exit;
    }

    $clienteModel = new Cliente($conn);

    $registroExitoso = $clienteModel->registrarUsuario($nombre, $apellidos, $correo, $password, $id_provincia, $detalle_direccion);

    if ($registroExitoso) {
        
        header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?success=Usuario%20registrado%20con%20éxito");
    } else {
        // Redirigir de vuelta al registro con un mensaje de error
        header("Location: /AmbienteWeb/views/registro.php?error=No%20se%20pudo%20registrar%20el%20usuario");
    }
    exit;
}

?>